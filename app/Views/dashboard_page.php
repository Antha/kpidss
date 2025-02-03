<?php $this->extend('template_header_main_page') ?>

<?php $this->section('content') ?>

<body>
    <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
    </div>
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
                        <div class="container-fluid">
                            <div class="main-menu-wrapper row justify-content-center mt-5">
                                <?php if($user_level == 'admin' || $user_level == 'agent_branch' || $user_level == 'agent_cluster'){ ?>
                                <div class="col-lg-2 col-sm-3 col-6 text-center rounded-circle">
                                    <a class="btn main-menu-btn" href="<?= session()->get('user_level') === 'admin' ? '/pnp_test' : '/camera'; ?>">
                                        <img class="img-fluid menu-icon-dark-blue" loading="lazy" src="<?= base_url('/img/icon-quiz-dark-blue.png') ?>">
                                        <img class="img-fluid menu-icon-light-blue" loading="lazy" src="<?= base_url('/img/icon-quiz-white.png') ?>">
                                        <h5 class="card-title mt-3">PNP TEST</h5> 
                                    </a>
                                </div>
                                <div class="col-lg-2 col-sm-3 col-6 text-center rounded-circle">
                                    <a class="btn main-menu-btn" href="<?php echo base_url('/kpi')?>">
                                        <img class="img-fluid menu-icon-dark-blue" loading="lazy" src="<?= base_url('/img/icon-kpi-dark-blue.png') ?>">
                                        <img class="img-fluid menu-icon-light-blue" loading="lazy" src="<?= base_url('/img/icon-kpi-white.png') ?>">
                                        <h5 class="card-title mt-3">KPI</h5> 
                                    </a>
                                </div>
                                <div class="col-lg-2 col-sm-3 col-6 text-center rounded-circle">
                                    <a class="btn main-menu-btn" href="<?php echo base_url('/loyalty')?>">
                                        <img class="img-fluid menu-icon-dark-blue" loading="lazy" src="<?= base_url('/img/icon-loyalty-dark-blue.png') ?>">
                                        <img class="img-fluid menu-icon-light-blue" loading="lazy" src="<?= base_url('/img/icon-loyalty-white.png') ?>">
                                        <h5 class="card-title mt-3">LOYALTY</h5>
                                    </a>
                                </div>
    
                                <div class="col-lg-2 col-sm-3 col-6 text-center rounded-circle">
                                    <a class="btn main-menu-btn cstm-width-main-menu-wrapper" href="<?php echo base_url('/product_knowledge')?>">
                                        <img class="img-fluid menu-icon-dark-blue cstm-main-menu-img" loading="lazy" src="<?= base_url('/img/icon-info-product-dark-blue.png') ?>">
                                        <img class="img-fluid menu-icon-light-blue cstm-main-menu-img" loading="lazy" src="<?= base_url('/img/icon-info-product-white.png') ?>">
                                        <h5 class="card-title cstm-main-menu-card-title">PRODUCT KNOWLEDGE</h5>
                                    </a>
                                </div>
                                <?php } if($user_level == 'admin' || $user_level == 'admin_cms'){ ?>
                                    <div class="w-100 mt-sm-4"></div>

                                    <div class="col-lg-2 col-sm-3 col-6 text-center rounded-circle">
                                        <a class="btn main-menu-btn cstm-width-main-menu-wrapper" href="<?php echo base_url('/loyalty_input')?>">
                                            <img class="img-fluid menu-icon-dark-blue cstm-main-menu-img" loading="lazy" src="<?= base_url('/img/icon-setting-dark-blue.png') ?>">
                                            <img class="img-fluid menu-icon-light-blue cstm-main-menu-img" loading="lazy" src="<?= base_url('/img/icon-setting-white.png') ?>">
                                            <h5 class="card-title cstm-main-menu-card-title">SET PRODUCT REDEEM</h5>
                                        </a>
                                    </div>

                                    <div class="col-lg-2 col-sm-3 col-6 text-center rounded-circle">
                                        <a class="btn main-menu-btn cstm-width-main-menu-wrapper" href="<?php echo base_url('/product_knowledge_input')?>">
                                            <img class="img-fluid menu-icon-dark-blue cstm-main-menu-img" loading="lazy" src="<?= base_url('/img/icon-setting-dark-blue.png') ?>">
                                            <img class="img-fluid menu-icon-light-blue cstm-main-menu-img" loading="lazy" src="<?= base_url('/img/icon-setting-white.png') ?>">
                                            <h5 class="card-title cstm-main-menu-card-title">SET PRODUCT KNOWLEDGE</h5>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>

        </div>
           
    </div>
</body>

<script>
    // Page load animation
    window.onload = function () {
        const loaderOverlay = document.getElementById('loader-overlay');
        const dashboardPage = document.querySelector('.dashboard-page');

        // Hide the loader and show the content
        loaderOverlay.style.display = 'none';
        dashboardPage.style.display = 'block';
    };
</script>

<?php $this->endSection() ?>