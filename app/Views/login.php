<?php $this->extend('template_header_login') ?>

<?php $this->section('content') ?>
<body>
    <div class="login-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12 bg-img">
                    <div class="row login-title-section">
                        <div class="col-xs-12 page-login-title">
                            <h1>BARBARA</h1>
                        </div>
                        <div class="col-xs-12 page-login-title-sm">
                            <h5>BALINUSRA BACKED ASSESMENT REPORTING APPS</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 form-section">
                    <div class="login-inner-form">
                        <div class="login-title-section-mobile">
                            <div class="page-login-title-mobile">
                                <h1>BARBARA</h1>
                            </div>
                        </div>
                        <div class="details">
                            <h3>Sign Into Your Account</h3>
                            <form action="#" method="GET">
                                <div class="form-group form-box">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                                </div>
                                <div class="form-group form-box">
                                    <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
                                </div>
                                <div class="form-group form-box checkbox clearfix">
                                    <div class="form-check checkbox-theme">
                                        <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">
                                            I am not a robot
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn-md btn-theme w-100">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php $this->endSection() ?>