<?php $this->extend('template_header_menu_page') ?>
<?php $this->section('content') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <div class="col-xs-12 mb-4 p-0">
                            <ul class="nav nav-tabs" style="padding: 0px 10px;">
                                <li class="nav-item">
                                    <a id="1" class="nav-link active" href="#">ADD</a>
                                </li>
                                <li class="nav-item">
                                    <a id="2" class="nav-link" href="#">EDIT</a>
                                </li>
                            </ul>
                        </div>
                        <section class="tabs">
                            <div class="tab-content-wrapper" id="tab-1">
                                <div class="row">
                                    <div class="col-xs-12 border rounded mb-2 mb-md-5">
                                        <div class="content-wrapper">
                                            <h3>ADD PRODUCT KNOWLEDGE</h3>
                                            <?php if (session()->getFlashdata('success')): ?>
                                                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                                            <?php endif; ?>
    
                                            <form id="uploadForm"  enctype="multipart/form-data">
                                                <?php csrf_field() ?>
                                                <div class="mb-3">
                                                    <label for="productName" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="productName" name="product_name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="productDetail" class="form-label">Detail</label>
                                                    <div class="form-control" id="productDetail" rows="3" required style=""></div>
                                                    <!--<input type="testarea" class="form-control" id="productDetail" name="product_detail" required>-->
                                                </div>
                                                <div class="mb-3">
                                                    <label for="photoInput" class="form-label">Choose Thumbnail Image</label>
                                                    <input type="file" class="form-control" id="photoInput" accept="image/*">
                                                </div>
                                                <div class="text-center">
                                                    <img id="image" class="img-fluid" style="display: none; max-height: 300px;">
                                                </div>
                                                <div class="preview text-center"></div>
                                                <div class="mb-3">
                                                    <label for="photoMainInput" class="form-label">Choose Main Image</label>
                                                    <input type="file" class="form-control" id="photoMainInput" accept="image/*">
                                                </div>
                                                <!-- Preview hasil crop -->
                                                <!-- <div class="text-center mt-3">
                                                    <h6>Preview Cropped Image</h6>
                                                    <img id="croppedPreview" class="img-fluid" style="display: none; max-height: 300px; border: 1px solid #ddd;">
                                                </div> -->
                                                <input type="hidden" id="hidden_dt_now" style="display: none;" value="<?php echo $dt_now; ?>"></input>
                                                <div class="text-center mt-3 mb-3">
                                                    <button type="button" id="cropButton" class="btn btn-primary">Crop & Upload Data</button>
                                                </div>
                                            </form>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content-wrapper" id="tab-2" style="display: none;">
                                <div class="row">
                                    <div class="col-xs-12 border rounded">
                                        <div class="content-wrapper">
                                            <h3>DELETE PRODUCT KNOWLEDGE</h3>
                                            <div class="table-scroll-y" style="height: 300px;">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover table-edit-pr">
                                                        <tr style="background-color: #003057;color:#fff;">
                                                            <th class="text-center">ID</th>
                                                            <th class="text-center" style="min-width: 100px;">IMAGE</th>
                                                            <th class="text-center" style="min-width: 100px;">TITLE</th>
                                                            <th class="text-center" style="min-width: 150px;">ACTION</th>
                                                        </tr>
                                                        <?php foreach($display_all_product as $rows){ ?>
                                                            <tr class="align-middle">
                                                                <td class="text-center"><?php echo $rows['id']; ?></td>
                                                                <td class="text-center"><img style="width: 50px;" loading="lazy" src="<?php echo base_url('/uploads/product_knowledge/').$rows['product_image'];?>"></td>
                                                                <td><?php echo $rows['product_name']; ?></td>
                                                                <td class="text-center">
                                                                    <button type="button" id="delete-<?php echo $rows['id']; ?>" class="btn btn-danger btn-delete" style="font-size: 12px;">DELETE</button>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>

        <?php echo $this->include('partials/include_footer'); ?>
        
        <!--modal-->
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background-color: transparent">
                    <div class="modal-body" style="background-color: #003057;border-radius: 8px;">
                        <div class="modal-title" style="text-align: center;padding: 30px 10px 0px 10px;">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-4">
                                        <img style="width: 60px;" class="img-fluid" style="height: 60px;" src="<?php echo base_url('/img/icon-success.png')?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h3 style="font-size: 20px;margin-top:15px;"><span id="success-info"></span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button id="btn-finish-modal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background-color: transparent">
                    <div class="modal-body" style="background-color: #003057;border-radius: 8px;">
                        <div class="modal-title" style="text-align: center;padding: 30px 10px 0px 10px;">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-4">
                                        <img style="width: 60px;" class="img-fluid" style="height: 60px;" src="<?php echo base_url('/img/icon-trash-bin.png')?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h3 style="font-size: 20px;margin-top:15px;"><span id="delete-info"></span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="justify-content: center;">
                            <button id="btn-delete-modal" type="button" class="btn btn-danger" style="font-size: 12px;">DELETE</button>
                            <button id="btn-finish-modal" type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="font-size: 12px;">CANCEL</button>
                            <input type="hidden" id="proccess-delete"></input>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="modal fade" id="failModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background-color: transparent">
                    <div class="modal-body" style="background-color: #003057;border-radius: 8px;">
                        <div class="modal-title" style="text-align: center;padding: 30px 10px 0px 10px;">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-4">
                                        <img style="width: 60px;" class="img-fluid" src="<?php echo base_url('/img/icon-fail.png')?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h3 style="font-size: 20px;margin-top:15px;"><span id="fail-info"></span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button id="btn-finish-modal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--modal-->
    </div>
</body>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<!-- 
<script src="script/quill/modules/DisplaySize.js"></script>
<script src="script/quill/modules/BaseModule.js"></script>
<script src="script/quill/modules/Resize.js"></script>
<script src="script/quill/modules/Toolbar.js"></script> -->

<script>
    // Pastikan Quill sudah didefinisikan sebelumnya
    // //Quill.register('modules/imageDrop', QuillImageDrop);
    // Quill.register('modules/imageResize', window.ImageResize);
    // Quill.register('modules/imageDrop', window.ImageDrop);

    // Initialize Quill editor
    var quill = new Quill('#productDetail', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': '1'}, { 'header': '2'}, { 'font': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['bold', 'italic', 'underline'],
                    ['link', 'image'], // Add image button
                ],
                imageDrop: true
            }
        });

        // Custom image upload handler
        const imageHandler = () => {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.addEventListener('change', () => {
                const file = input.files[0];
                if (file) {
                    const formData = new FormData();
                    formData.append('upload', file);

                    // Replace with your image upload endpoint
                    fetch('/editor/upload', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.location) {
                            const range = quill.getSelection();
                            const imageUrl = data.location; // Assuming your server returns the image URL
                            quill.insertEmbed(range.index, 'image', imageUrl);
                        }
                    })
                    .catch(error => {
                        console.error('Error uploading image:', error);
                    });
                }
            });
        };

        // Add the custom image handler to the toolbar
        const toolbar = quill.getModule('toolbar');
        toolbar.addHandler('image', imageHandler);
</script>

<!-- Cropper.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
    $('body').fadeIn(1000);
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

    function beforeSendCustom(){
        Swal.fire({
            title: 'Please wait...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading(); // Menampilkan loading animasi bawaan Swal
            }
        });
    }

    function afterSendCustom(){
        Swal.close();
    }
    
    let cropper;
    const photoInput = document.getElementById('photoInput');
    const photoMainInput = document.getElementById('photoMainInput');
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


    let photoMainInputFiles;
    photoMainInput.addEventListener('change', (event) => {
        photoMainInputFiles = event.target.files[0];
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
            formData.append('product_detail', document.getElementById('productDetail').innerHTML);
            formData.append('photoMainInputFiles', photoMainInputFiles); 
       
            // Preview the cropped image
            //const croppedPreview = document.getElementById('croppedPreview');
            const croppedURL = URL.createObjectURL(blob);
            // croppedPreview.src = croppedURL;
            // croppedPreview.style.display = 'block';

            beforeSendCustom();
            // Upload to server
            fetch('/product_knowledge_upload', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    afterSendCustom();
                    $("#successModal").modal('show');
                    $("#success-info").text("Data Berhasil diupload");
                    console.log(data.file_name); // Tampilkan nama file yang diupload
                    window.location.reload();
                } else {
                    afterSendCustom();
                    $("#failModal").modal('show');
                    $("#fail-info").text('Upload failed: ' + data.message);
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Upload failed:', error);
            });
        });
    });

    //tab function
    $(".nav-tabs li a").on("click", function () {
        
        // Get The ID Of a When I Clicked
        var myID = $(this).attr("id");
        
        // Remove Class Inactive When I clicked And Add It In Siblings In Ul
        $(".nav-tabs li a").removeClass("active");
        $(this).addClass("active");
        
        // Hide The Div When i Clicked
        $(".tabs div.tab-content-wrapper").hide();
        
        // When Clicked In Li Get Div Same ID
        
        $("#tab-" + myID).fadeIn(1000);
    });

    //delete function
    $(".btn-delete").on("click",function(){
        let myID = $(this).attr("id");
        let productId = myID.split("delete-");
        
        $.ajax({
            type:"post",
            url :"<?php echo base_url(); ?>/product_knowledge/get_selected_product",
            data: {
                product_id : productId[1]
            },
            dataType: "json",
            cache: false,
            beforeSend:function(){
                // Tampilkan swal dengan loading
                Swal.fire({
                    title: 'Please wait...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading(); // Menampilkan loading animasi bawaan Swal
                    }
                });
            },
            success: function (data) 
            {
                if(data.info == 'success'){
                    Swal.close(); // Tutup swal setelah AJAX selesai
                    $("#deleteConfirmationModal").modal('show');
                    $('#deleteConfirmationModal').modal({backdrop: 'static', keyboard: false})  //prevent closing from outside box click
                    $("#proccess-delete").val(productId[1]);
                    $("#delete-info").text("Delete " + data.parse_product_name + "?");
                }
            }
        });
    });

    $("#btn-delete-modal").on("click",function(){
        let productId = $("#proccess-delete").val();
        $("#deleteConfirmationModal").modal('hide');
        $.ajax({
            type:"post",
            url :"<?php echo base_url(); ?>/product_knowledge/delete_selected_product",
            data: {
                product_id : productId
            },
            dataType: "json",
            cache: false,
            beforeSend:function(){
                // Tampilkan swal dengan loading
                Swal.fire({
                    title: 'Please wait...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading(); // Menampilkan loading animasi bawaan Swal
                    }
                });
            },
            success: function (data) 
            {
                if(data.info == 'success'){
                    Swal.close(); // Tutup swal setelah AJAX selesai
                    $("#successModal").modal('show');
                    $("#success-info").text("Data Berhasil Dihapus");
                    window.location.reload();
                }
            }
        });
    });
    
</script>

<?php $this->endSection() ?>
