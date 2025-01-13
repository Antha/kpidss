<?php $this->extend('template_header_menu_page') ?>

<?php $this->section('content') ?>

<body>
    <div class="dashboard-page">
        
        <div class="sidebar w3-bar-block w3-card animate-left" style="display:none" id="mySidebar">
            <div class="close-nav-btn-wrapper">
                <button class="btn close-nav-btn" onclick="w3_close()">&times;</button>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link active" aria-current="page" href="#">PNP TEST</a>
                <a class="nav-link" href="#">KPI</a>
                <a class="nav-link" href="#">LOYALTY</a>
            </nav>  
        </div>

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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="content-wrapper">
                                <div class="row w-100">
                                    <div class="col-md-6 offset-md-3 text-center">
                                        <div class="card shadow">
                                            <div class="card-body">
                                            <?php if (!is_array(session('unfinishedQuiz'))) : ?>
                                                <h5 class="card-title">Camera Capture</h5>
                                                <button id="capture" class="btn btn-primary mt-3 mb-3">Capture</button>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <video id="video" autoplay class="border rounded" style="max-width: 100%; height: auto;"></video>
                                                </div>
                                                <canvas id="canvas" class="mt-3 border rounded" style="max-width: 100%; display: none;"></canvas>
                                                <form id="saveForm" method="POST" action="/camera/save" class="mt-4 text-center">
                                                    <input type="hidden" name="imageData" id="imageData">
                                                    <button type="submit" id="saveButton" class="btn btn-success" disabled>Save</button>
                                                </form>
                                                <?php else : ?>
                                                    <div class="alert alert-danger text-center mt-4">
                                                        <h5 class="card-title text-danger">You have an unfinished quiz</h5>
                                                        <p class="mb-3">Do you want to continue working on your quiz?</p>
                                                        <div class="d-flex justify-content-center gap-3">
                                                            <a href="/quiz" class="btn btn-success">Yes</a>
                                                            <a href="/dashboard" class="btn btn-secondary">No</a>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    const video = document.getElementById('video');
                                    const canvas = document.getElementById('canvas');
                                    const captureButton = document.getElementById('capture');
                                    const saveButton = document.getElementById('saveButton');
                                    const imageDataInput = document.getElementById('imageData');

                                    // Akses kamera
                                    navigator.mediaDevices.getUserMedia({ video: true })
                                        .then((stream) => {
                                            video.srcObject = stream;
                                        })
                                        .catch((err) => {
                                            console.error('Error accessing camera: ', err);
                                        });

                                    // Capture gambar
                                    captureButton.addEventListener('click', () => {
                                        const context = canvas.getContext('2d');
                                        canvas.width = video.videoWidth;
                                        canvas.height = video.videoHeight;
                                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                                        // Tampilkan canvas
                                        canvas.style.display = 'block';

                                        // Ambil data gambar sebagai base64
                                        const imageData = canvas.toDataURL('image/png');
                                        imageDataInput.value = imageData;
                                        saveButton.disabled = false;

                                        const scrollHeight = document.body.scrollHeight;
                                        
                                        const scrollStep = 500;
                                        function scrollStepDown() {
                                            if (window.scrollY + window.innerHeight < scrollHeight) {
                                                window.scrollBy(0, scrollStep);
                                                requestAnimationFrame(scrollStepDown);
                                            }
                                        }

                                        scrollStepDown();
                                    });
                                </script>
                            </div> 
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</body>

<link rel="stylesheet" href="<?php echo base_url('/css/datepicker.css') ?>">
<script type="text/javascript" src="<?php echo base_url('/script/bootstrap-datepicker.js') ?>"></script>
<script>
    function w3_open() {
    document.getElementById("main").style.marginLeft = "25%";
    document.getElementById("mySidebar").style.width = "25%";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("openNav").style.display = 'none';
    }
    function w3_close() {
    document.getElementById("main").style.marginLeft = "0%";
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("openNav").style.display = "inline-block";
    }

    $('#periode_data').datepicker({
        format: "yyyymm",
        startView: 1,
        minViewMode:1,
        autoclose: true,
        todayHighlight: true
    });
</script>

<?php $this->endSection() ?>