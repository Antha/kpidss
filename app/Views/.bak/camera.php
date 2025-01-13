<?php $this->extend('template_header_main_page') ?>

<?php $this->section('content') ?>
<body>
    <div class="dashboard-page">
        <div id="main" class="main-content-dashboard">
            <div class="header-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-lg-12">
                            <div class="main-header-wrapper">
                                <div class="user-name-ses-display text-end">
                                    <h6 class="d-inline-block"> <?= session('username') ?></h6>
                                    <form class="float-end btn-logout-form" action="">
                                        <button class="btn btn_logout" type="submit" name="LOGOUT" title="LOGOUT">
                                            <div class="inner_content">
                                                <i class="fa-solid fa-right-from-bracket"></i>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>                   
                    </div>
                </div>
            </div>
            <div class="dashboard-menu">
                <div class="container-fluid">
                    <div class="row w-100">
                        <div class="col-md-6 offset-md-3 text-center">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Camera Capture</h5>
                                    <button id="capture" class="btn btn-primary mt-3">Capture</button>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <video id="video" autoplay class="border rounded" style="max-width: 100%; height: auto;"></video>
                                    </div>
                                    <canvas id="canvas" class="mt-3 border rounded" style="max-width: 100%; display: none;"></canvas>
                                    <form id="saveForm" method="POST" action="/camera/save" class="mt-4 text-center">
                                        <input type="hidden" name="imageData" id="imageData">
                                        <button type="submit" id="saveButton" class="btn btn-success" disabled>Save</button>
                                    </form>
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
</body>

<?php $this->endSection() ?>
