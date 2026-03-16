<?php $this->extend('template_header_main_page') ?>

<?php $this->section('content') ?>

<body>
     <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="dashboard-page">
        <div id="main" class="main-content-dashboard">
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
                            <div class="main-menu-wrapper row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4 justify-content-center mt-5">
                                <?php if($user_level == 'admin' || $user_level == 'agent_branch' || $user_level == 'agent_cluster'){ ?>
                                <div class="col-lg-2 col-sm-3 col-6 text-center mb-3">
                                    <a class="btn main-menu-btn rounded-circle-cstm pt-4" href="<?php echo base_url('/pnp_test')?>">
                                        <div class="card">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-7 col-sm-9 col-md-9 col-lg-7 col-xl-7 mx-auto">
                                                        <img class="card-img-top img-responsive" loading="lazy" src="<?= base_url('/img/PNP_TEST_V2.png') ?>" alt="PNP TEST">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="card-body mb-2 pt-3 pb-4 pb-lg-3 pb-lg-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h6 class="card-title">PNP TEST</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-sm-3 col-6 text-center mb-3">
                                    <a class="btn main-menu-btn rounded-circle-cstm pt-4" href="<?php echo base_url('/kpi')?>">
                                        <div class="card">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-7 col-sm-9 col-md-9 col-lg-7 col-xl-7 mx-auto">
                                                        <img class="card-img-top img-responsive" loading="lazy" src="<?= base_url('/img/KPI_V2.png') ?>" alt="KPI">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="card-body mb-2 pt-3 pb-4 pb-lg-3 pb-lg-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h6 class="card-title">KPI</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-sm-3 col-6 text-center mb-3">
                                    <a class="btn main-menu-btn rounded-circle-cstm pt-4" href="<?php echo base_url('/loyalty')?>">
                                        <div class="card">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-7 col-sm-9 col-md-9 col-lg-7 col-xl-7 mx-auto">
                                                        <img class="card-img-top img-responsive" loading="lazy" src="<?= base_url('/img/LOYALTY_V2.png') ?>" alt="LOYALTY">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="card-body mb-2 pt-3 pb-4 pb-lg-3 pb-lg-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h6 class="card-title">LOYALTY</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                    </a>
                                </div>
    
                                <div class="col-lg-2 col-sm-3 col-6 text-center mb-3">
                                    <a class="btn main-menu-btn rounded-circle-cstm pt-4" href="<?php echo base_url('/product_knowledge')?>">
                                        <div class="card">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-7 col-sm-9 col-md-9 col-lg-7 col-xl-7 mx-auto">
                                                        <img class="card-img-top img-responsive" loading="lazy" src="<?= base_url('/img/PRODUCT_KNOWLEDGE_V2.png') ?>" alt="PRODUCT_KNOWLEDGE">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="card-body mb-2 pt-3 pb-4 pb-lg-3 pb-lg-4">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h6 class="card-title">PRODUCT </br>KNOWLEDGE</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                    </a>
                                </div>

                                <?php } if($user_level == 'admin' || $user_level == 'admin_cms'){ ?>
                                    <div class="w-100 mt-sm-1"></div>
                                    
                                    <div class="col-lg-2 col-sm-3 col-6 text-center mb-3">
                                        <a class="btn main-menu-btn rounded-circle-cstm pt-4" href="<?php echo base_url('/loyalty_input')?>">
                                            <div class="card">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-8 col-sm-9 col-md-9 col-lg-8 col-xl-8 mx-auto">
                                                            <img class="card-img-top img-responsive" loading="lazy" src="<?= base_url('/img/SET_PRODUCT_REDEEM_V2.png') ?>" alt="SET_PRODUCT_REDEEM">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="card-body mb-2 pt-3 pb-4 pb-lg-3 pb-lg-4">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h6 class="card-title">SET PRODUCT </br>REDEEM</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>      
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-lg-2 col-sm-3 col-6 text-center mb-3">
                                        <a class="btn main-menu-btn rounded-circle-cstm pt-4" href="<?php echo base_url('/product_knowledge_input')?>">
                                            <div class="card">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-8 col-sm-9 col-md-9 col-lg-8 col-xl-8 mx-auto">
                                                            <img class="card-img-top img-responsive" loading="lazy" src="<?= base_url('/img/SET_PRODUCT_REDEEM_V2.png') ?>" alt="SET_PRODUCT_KNOWLEDGE">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="card-body mb-2 pt-3 pb-4 pb-lg-3 pb-lg-4">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h6 class="card-title">SET PRODUCT </br>KNOWLEDGE</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>      
                                            </div>
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
    // Saat semua resource selesai dimuat
    window.addEventListener("load", function() {
      // Hilangkan preloader
      document.getElementById("preloader").style.display = "none";
      // Tambahkan class loaded agar body fade-in
      document.body.classList.add("loaded");
    });
</script>

<?php $this->endSection() ?>