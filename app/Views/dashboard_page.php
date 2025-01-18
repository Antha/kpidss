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
                                <?php echo $this->include('partials/include_header_top') ?>
                            </div>
                        </div>                   
                    </div>
                </div>
            </div>
            <div class="dashboard-menu">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-header-title mt-5">
                                <div class="display-3 text-center">
                                   BARBARA
                                </div>
                            </div>
                        </div>
                        <div class="main-menu-wrapper row justify-content-md-center mt-5">
                            <div class="col-lg-3 col-md-3 text-center">
                                <a class="btn main-menu-btn" href="<?= session()->get('user_level') === 'admin' ? '/pnp_test' : '/camera'; ?>">
                                    <img class="card-img-top menu-icon-dark-blue" src="<?= base_url('/img/icon-quiz-dark-blue.png') ?>">
                                    <img class="card-img-top menu-icon-light-blue" src="<?= base_url('/img/icon-quiz-white.png') ?>">
                                    <h5 class="card-title mt-3">PNP TEST</h5> 
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 text-center">
                                <a class="btn main-menu-btn" href="/kpi">
                                    <img class="card-img-top menu-icon-dark-blue" src="<?= base_url('/img/icon-kpi-dark-blue.png') ?>">
                                    <img class="card-img-top menu-icon-light-blue" src="<?= base_url('/img/icon-kpi-white.png') ?>">
                                    <h5 class="card-title mt-3">KPI</h5> 
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 text-center">
                                <a class="btn main-menu-btn">
                                    <img class="card-img-top menu-icon-dark-blue" src="<?= base_url('/img/icon-loyalty-dark-blue.png') ?>">
                                    <img class="card-img-top menu-icon-light-blue" src="<?= base_url('/img/icon-loyalty-white.png') ?>">
                                    <h5 class="card-title mt-3">LOYALTY</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>

        </div>
           
    </div>
</body>

<?php $this->endSection() ?>