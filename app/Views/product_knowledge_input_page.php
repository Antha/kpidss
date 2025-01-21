<?php $this->extend('template_header_menu_page') ?>

<?php $this->section('content') ?>
<!-- Cropper.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.css">
<body>
    <div class="admin-cms-page">
        
        <?php echo $this->include('partials/include_sidebar') ?>

        <div id="main">
            <div class="header-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-lg-12">
                            <div class="main-header-wrapper">
                                <button id="openNav" class="btn float-start open-nav-btn" onclick="w3_open()">&#9776;</button>
                                <div class="main-header-title mt-2">
                                    <h6>BARBARA</h6>
                                </div>
                                <?php echo $this->include('partials/include_header_top') ?>
                            </div>
                        </div>                   
                    </div>
                </div>
            </div>

            <div class="dashboard-menu">
                <div class="container mt-md-5 mt-2">
                    <div class="row">
                        <div class="col-xs-12 border rounded mb-2 mb-md-5">
                            <div class="content-wrapper">
                                <h3>ADD PRODUCT KNOWLEDGE</h3>
                                <?php if (session()->getFlashdata('success')): ?>
                                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                                <?php endif; ?>

                                <form id="uploadForm">
                                    <?php csrf_field() ?>
                                    <div class="mb-3">
                                        <label for="productName" class="form-label">Product Name</label>
                                        <input type="text" class="form-control" id="productName" name="product_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productDetail" class="form-label">Product Detail</label>
                                        <textarea class="form-control" id="productDetail" rows="3" required></textarea>
                                        <!--<input type="testarea" class="form-control" id="productDetail" name="product_detail" required>-->
                                    </div>
                                    <div class="mb-3">
                                        <label for="photoInput" class="form-label">Choose Image</label>
                                        <input type="file" class="form-control" id="photoInput" accept="image/*">
                                    </div>
                                    <div class="text-center">
                                        <img id="image" class="img-fluid" style="display: none; max-height: 300px;">
                                    </div>
                                    <div class="preview text-center"></div>

                                    <!-- Preview hasil crop -->
                                    <!-- <div class="text-center mt-3">
                                        <h6>Preview Cropped Image</h6>
                                        <img id="croppedPreview" class="img-fluid" style="display: none; max-height: 300px; border: 1px solid #ddd;">
                                    </div> -->

                                    <div class="text-center mt-3 mb-3">
                                        <button type="button" id="cropButton" class="btn btn-primary" style="display: none;">Crop & Upload Data</button>
                                    </div>
                                </form>

                            </div> 
                        </div>

                        <!--<div class="col-xs-12 border rounded">
                            <div class="content-wrapper">
                                <h3>EDIT PRODUCT REDEEM</h3>
                                <?php if (session()->getFlashdata('success')): ?>
                                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                                <?php endif; ?>

                                <form id="editForm">
                                    <?php csrf_field() ?>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="button" id="editButton" class="btn btn-primary" style="display: none;">Crop & Edit Data</button>
                                    </div>
                                </form>

                            </div> 
                        </div>-->
                    </div>
                </div>
            </div>
        </div>

        <?php echo $this->include('partials/include_footer'); ?>
        
    </div>
</body>

<!-- Cropper.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
    function w3_open() {
        $('#main').removeClass('main-sidebar-close');
        $('#main').addClass('main-sidebar-open');
        $('#footer').removeClass('main-sidebar-close');
        $('#footer').addClass('main-sidebar-open');
        $('#mySidebar').removeClass('sidebar-close');
        $('#mySidebar').addClass('sidebar-open');
        $('.dashboard-menu').addClass('main-sidebar-open');
        $('.dashboard-menu').removeClass('main-sidebar-close');
        document.getElementById("openNav").style.display = 'none';
    }
    function w3_close() {
        $('#main').removeClass('main-sidebar-open');
        $('#main').addClass('main-sidebar-close');
        $('#footer').addClass('main-sidebar-close');
        $('#footer').removeClass('main-sidebar-open');
        $('#mySidebar').removeClass('sidebar-open');
        $('#mySidebar').addClass('sidebar-close');
        $('.dashboard-menu').removeClass('main-sidebar-open');
        $('.dashboard-menu').addClass('main-sidebar-close');
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
    }
    
    let cropper;
    const photoInput = document.getElementById('photoInput');
    const image = document.getElementById('image');
    const cropButton = document.getElementById('cropButton');

    photoInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                image.src = e.target.result;
                image.style.display = 'block';

                // Initialize Cropper.js
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                });

                // Show the Crop & Upload button
                cropButton.style.display = 'inline-block';
            };
            reader.readAsDataURL(file);
        }
    });

    cropButton.addEventListener('click', () => {
        const croppedCanvas = cropper.getCroppedCanvas({
            width: 200, // Output width
            height: 200, // Output height
        });

        // Convert to Blob for upload
        croppedCanvas.toBlob((blob) => {
            const formData = new FormData();
            formData.append('croppedImage', blob);
            formData.append('product_name', document.getElementById('productName').value);
            formData.append('product_detail', document.getElementById('productDetail').value);

            // Preview the cropped image
            //const croppedPreview = document.getElementById('croppedPreview');
            const croppedURL = URL.createObjectURL(blob);
            // croppedPreview.src = croppedURL;
            // croppedPreview.style.display = 'block';

            // Upload to server
            fetch('/product_knowledge_upload', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Upload successful!');
                    console.log(data.file_name); // Tampilkan nama file yang diupload
                } else {
                    alert('Upload failed: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Upload failed:', error);
            });
        });
    });
</script>

<?php $this->endSection() ?>
