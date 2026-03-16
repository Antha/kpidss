<?php $this->extend('template_header_login') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<?php $this->section('content') ?>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="login-page">
        
        <div class="container-fluid">
            <div class="row row-cols-2 pt-4 pt-md-5">
               <div class="col-6 col-md-8 section-logo-barbara">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-5 align-self-start">
                                <img class="img-fluid ms-0 ms-md-5" loading="lazy" src="<?= base_url('/img/logo_br_kiri_atas.png') ?>" alt="Logo Barbara">
                            </div>
                        </div>
                    </div>
               </div>
               <div class="col-6 col-md-4 section-logo-telkomsel">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <img class="img-fluid pt-1" loading="lazy" src="<?= base_url('/img/Logo Telkomsel Baru V2.png') ?>" alt="Logo Telkomsel">
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row row-cols-1 mt-4 mt-md-5">
                <div class="col-12 col-md-8 section-logo-barbara">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-7 align-self-start ms-0 ms-md-5 ms-lg-5">
                                <div class="details login-form-wrapper ps-4 pe-4 pt-4 pb-4 ps-md-5 pe-md-5 pt-md-4 pb-md-4">
                                    <div class="login-form-title d-block text-center mb-4">
                                        <h5 class="fw-bold">Sign Into Your Account</h5>
                                    </div>
                                   
                                    <?php if (session()->getFlashdata('error')): ?>
                                        <p class="error" style="color: #ff1c1c;"><?= session()->getFlashdata('error') ?></p>
                                    <?php endif; ?>

                                    <form class="login-form" action="<?= esc(base_url('/login/authenticate')) ?>" method="POST">
                                        <?= csrf_field() ?>
                                        <!-- Email Input -->
                                        <div class="form-group form-box mb-3">
                                            <input type="text" name="email" id="email" class="form-control" placeholder="Email Address/Username" aria-label="Email Address" required>
                                        </div>

                                        <!-- Password Input -->
                                        <div class="form-group form-box mb-3">
                                            <input type="password" name="password" id="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password" required minlength="6"
                                            title="Password must be at least 6 characters long.">
                                        </div>

                                        <!-- Security Checkbox -->
                                        <div class="form-group form-box checkbox clearfix mb-3">
                                            <div class="form-check checkbox-theme">
                                                <input class="form-check-input" type="checkbox" id="security_chckbox" required>
                                                <label class="form-check-label" for="security_chckbox">
                                                    <span class="fw-bold">I am not a robot</span>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="form-group">
                                            <button id="btn_login" type="submit" class="btn-md btn-theme w-100 disable-btn rounded pt-2 pb-2 fw-bold text-white" disabled>LOGIN</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
</body>

<script>
    // Saat semua resource selesai dimuat
    window.addEventListener("load", function() {
      // Hilangkan preloader
      document.getElementById("preloader").style.display = "none";
      // Tambahkan class loaded agar body fade-in
      document.body.classList.add("loaded");
    });

    $(document).ready(function () {
        $(function () {
            $('#security_chckbox').on('change', function () {
                $('#btn_login').prop('disabled', !this.checked).toggleClass('disable-btn', !this.checked);
            });
        }); 

        window.addEventListener("load", function() {
            document.body.classList.add("loaded");
        });

    });
</script>

<?php $this->endSection() ?>
