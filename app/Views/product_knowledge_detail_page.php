<?php $this->extend('template_header_menu_page') ?>

<?php $this->section('content') ?>

<body>
    <div class="dashboard-page page_height">
        
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

            <div class="dashboard-menu page-height">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="content-wrapper">
                                <div class="date-update-wrapper">
                                    <a href="<?php echo base_url()."product_knowledge"?>" class="back-btn">
                                        <i class="fa-regular fa-circle-left float-start" style="font-size: 25px;padding-top: 2px;margin-right: 10px;"></i>
                                    </a>
                                    <h4 class="dark-blue-text float-end">PRODUCT DETAIL</h4>
                                    <div style="clear: both;"></div>
                                </div>
                                <div class="point-content">
                                    <div class="container-fluid product-knowledge mt-4">
                                        <div class="row justify-content-center">
                                            <div class="col-12">
                                                <!--<img class="img-fluid" loading="lazy " style="width: 100%;height:250px;" src="<?php echo base_url('/uploads/product_knowledge/').$detail[0]["product_main_image"]; ?>">-->
                                                <img class="img-fluid" loading="lazy " style="width: 100%;height:350px;" src="<?php echo base_url('/img/test-banner.jpg'); ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-start mt-4 mb-2">
                                                <h3 style="color: #003057;"><?php echo $detail[0]['product_name']; ?></h3>
                                            </div>
                                            <div class="col-12 mb-1">
                                                <h6 class="fst-italic" style="color: #0c7a99;"><?php echo $detail[0]['created_date']; ?></h6>
                                            </div> 
                                            <div class="col-12 product-detail-wrapper">
                                                <span><?php echo $detail[0]['product_detail']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $this->include('partials/include_footer'); ?>
    </div>
</body>

<script>
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
</script>

<?php $this->endSection() ?>