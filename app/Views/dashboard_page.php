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
                                    <?php if ($unfinishedQuiz) { ?>
                                        <span style="color:red; padding:10px">Sorry, You Have Unfinished PNP Test</span>
                                    <?php } ?>
                                    <h6 class="d-inline-block"> <?= session('username') ?></h6>
                                    <form class="float-end btn-logout-form" action="/">
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
                                    <img class="card-img-top menu-icon" src="<?= base_url('/img/icon-quiz3.png') ?>">
                                    <h5 class="card-title mt-3">PNP TEST</h5> 
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 text-center">
                                <a class="btn main-menu-btn">
                                    <img class="card-img-top menu-icon" src="<?= base_url('/img/icon-kpi.png') ?>">
                                    <h5 class="card-title mt-3">KPI</h5> 
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3 text-center">
                                <a class="btn main-menu-btn">
                                    <img class="card-img-top menu-icon" src="<?= base_url('/img/icon-loyalty2.png') ?>">
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