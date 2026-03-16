<?php $this->extend('template_header_login') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<?php $this->section('content') ?>
<body>
    <div class="login-page">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Section (Image/Logo) -->
                <div class="col-lg-6 col-md-12 bg-img">
                    <div class="login-title-section">
                        <div class="col-sm-6 page-login-logo">
                            <img class="img-fluid" loading="lazy" src="<?= esc(base_url('/img/Logo_Barbara.png')) ?>" alt="Logo">
                        </div>
                    </div>
                </div>

                <!-- Right Section (Login Form) -->
                <div class="col-lg-6 col-md-12 form-section">
                    <div class="login-inner-form">
                        <!-- Mobile Logo -->
                        <div class="login-title-section-mobile">
                            <div class="page-login-title-mobile row justify-content-center">
                                <div class="col-5 page-login-logo-mobile">
                                    <img class="img-fluid" loading="lazy" src="<?= esc(base_url('/img/Logo_Barbara.png')) ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Login Form -->
                        <div class="details">
                            <h3>Sign Into Your Account</h3>

                            <?php if (session()->getFlashdata('error')): ?>
                                <p class="error" style="color: #ff1c1c;"><?= session()->getFlashdata('error') ?></p>
                            <?php endif; ?>

                            <form action="<?= esc(base_url('/login/authenticate')) ?>" method="POST">
                                <?= csrf_field() ?>
                                <!-- Email Input -->
                                <div class="form-group form-box">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email Address/Username" aria-label="Email Address" required>
                                </div>

                                <!-- Password Input -->
                                <div class="form-group form-box">
                                    <input type="password" name="password" id="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password" required minlength="6"
                                    title="Password must be at least 6 characters long.">
                                </div>

                                <!-- Security Checkbox -->
                                <div class="form-group form-box checkbox clearfix">
                                    <div class="form-check checkbox-theme">
                                        <input class="form-check-input" type="checkbox" id="security_chckbox" required>
                                        <label class="form-check-label" for="security_chckbox">
                                            I am not a robot
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button id="btn_login" type="submit" class="btn-md btn-theme w-100 disable-btn" disabled>Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function () {
        $(function () {
            $('#security_chckbox').on('change', function () {
                $('#btn_login').prop('disabled', !this.checked).toggleClass('disable-btn', !this.checked);
            });
        }); 
    });
</script>

<?php $this->endSection() ?>
