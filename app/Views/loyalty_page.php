<?php $this->extend('template_header_menu_page') ?>

<?php $this->section('content') ?>

<body>
    <div class="dashboard-page">
        
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

            <div class="dashboard-menu">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="content-wrapper">
                                <div class="date-update-wrapper">
                                    <a href="<?php echo base_url()."dashboard"?>" class="back-btn">
                                        <i class="fa-regular fa-circle-left float-start" style="font-size: 25px;padding-top: 2px;margin-right: 10px;"></i>
                                    </a>
                                    <h4 class="red-text float-end">LOYALTY</h4>
                                    <div style="clear: both;"></div>
                                </div>
                                <div class="point-content">

                                    <div class="point-info">
                                        <div class="row mt-4">
                                            <div class="icon-wrapper1">
                                                <img class="img-fluid" src="<?php echo base_url('/img/icon-loyalty.png')?>">
                                            </div>
                                            <div class="col-4" style="padding-top: 8px;color: #ea2c2c;">
                                                <h5>POINT ANDA SAAT INI : 100</h5>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="product-redeem mt-4">
                                        <div class="row">
                                            <div class="col-md-2 col-6 mb-2">
                                                <div class="card">
                                                    <img class="card-img-top img-fluid" src="<?php echo base_url('/img/prize1.jpg')?>" alt="prize-redeem">
                                                    <div class="card-body">
                                                        <h5 class="card-title">iPhone 13</h5>
                                                        <p class="card-text float-start" style="font-size: 14px;color: #ea2c2c;">1000 poin</p>
                                                        <p class="card-text float-end" style="font-size: 14px;text-transform:uppercase">Stocks 5</p>
                                                        <div style="clear: both;"></div>
                                                        <a href="#" class="btn submit_btn float-end">REDEEM</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-6 mb-2">
                                                <div class="card">
                                                    <img class="card-img-top img-fluid" src="<?php echo base_url('/img/prize2.jpg')?>" alt="prize-redeem">
                                                    <div class="card-body">
                                                        <h5 class="card-title">iPhone 13</h5>
                                                        <p class="card-text float-start" style="font-size: 14px;color: #ea2c2c;">1000 poin</p>
                                                        <p class="card-text float-end" style="font-size: 14px;text-transform:uppercase">Stocks 5</p>
                                                        <div style="clear: both;"></div>
                                                        <a href="#" class="btn submit_btn float-end">REDEEM</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-6 mb-2">
                                                <div class="card">
                                                    <img class="card-img-top" src="<?php echo base_url('/img/prize1.jpg')?>" alt="prize-redeem">
                                                    <div class="card-body">
                                                        <h5 class="card-title">iPhone 13</h5>
                                                        <p class="card-text float-start" style="font-size: 14px;color: #ea2c2c;">1000 poin</p>
                                                        <p class="card-text float-end" style="font-size: 14px;text-transform:uppercase">Stocks 5</p>
                                                        <div style="clear: both;"></div>
                                                        <a href="#" class="btn submit_btn float-end">REDEEM</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-6 mb-2">
                                                <div class="card">
                                                    <img class="card-img-top" src="<?php echo base_url('/img/prize1.jpg')?>" alt="prize-redeem">
                                                    <div class="card-body">
                                                        <h5 class="card-title">iPhone 13</h5>
                                                        <p class="card-text float-start" style="font-size: 14px;color: #ea2c2c;">1000 poin</p>
                                                        <p class="card-text float-end" style="font-size: 14px;text-transform:uppercase">Stocks 5</p>
                                                        <div style="clear: both;"></div>
                                                        <a href="#" class="btn submit_btn float-end">REDEEM</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-6 mb-2">
                                                <div class="card">
                                                    <img class="card-img-top" src="<?php echo base_url('/img/prize1.jpg')?>" alt="prize-redeem">
                                                    <div class="card-body">
                                                        <h5 class="card-title">iPhone 13</h5>
                                                        <p class="card-text float-start" style="font-size: 14px;color: #ea2c2c;">1000 poin</p>
                                                        <p class="card-text float-end" style="font-size: 14px;text-transform:uppercase">Stocks 5</p>
                                                        <div style="clear: both;"></div>
                                                        <a href="#" class="btn submit_btn float-end">REDEEM</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-6 mb-2">
                                                <div class="card">
                                                    <img class="card-img-top" src="<?php echo base_url('/img/prize1.jpg')?>" alt="prize-redeem">
                                                    <div class="card-body">
                                                        <h5 class="card-title">iPhone 13</h5>
                                                        <p class="card-text float-start" style="font-size: 14px;color: #ea2c2c;">1000 poin</p>
                                                        <p class="card-text float-end" style="font-size: 14px;text-transform:uppercase">Stocks 5</p>
                                                        <div style="clear: both;"></div>
                                                        <a href="#" class="btn submit_btn float-end">REDEEM</a>
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
               
            </div>

        </div>

        <?php echo $this->include('partials/include_footer'); ?>
           
    </div>
</body>

<link rel="stylesheet" href="<?php echo base_url('/css/datepicker.css') ?>">
<script type="text/javascript" src="<?php echo base_url('/script/bootstrap-datepicker.js') ?>"></script>
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

    $('#periode_data').datepicker({
        format: "yyyymm",
        startView: 1,
        minViewMode:1,
        autoclose: true,
        todayHighlight: true
    });
    
    if($('#hidden-value-branch').text() =="DENPASAR"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="BALI BARAT">BALI BARAT</option>');
        $('#kpi_filter_cluster_agent').append('<option value="BALI TENGAH">BALI TENGAH</option>');
        $('#kpi_filter_cluster_agent').append('<option value="BALI TIMUR">BALI TIMUR</option>');
    }else if($('#hidden-value-branch').text() =="FLORES"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="ENDE SIKKA">ENDE SIKKA</option>');
        $('#kpi_filter_cluster_agent').append('<option value="FLORES TIMUR">FLORES TIMUR</option>');
        $('#kpi_filter_cluster_agent').append('<option value="MANGGARAI">MANGGARAI</option>');
    }else if($('#hidden-value-branch').text() =="KUPANG"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="KUPANG ROTE">KUPANG ROTE</option>');
        $('#kpi_filter_cluster_agent').append('<option value="MALAKA TIMTIM BELU">MALAKA TIMTIM BELU</option>');
        $('#kpi_filter_cluster_agent').append('<option value="SUMBA">SUMBA</option>');
    }else if($('#hidden-value-branch').text() =="MATARAM"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="LOMBOK">LOMBOK</option>');
        $('#kpi_filter_cluster_agent').append('<option value="SUMBAWA BARAT">SUMBAWA BARAT</option>');
        $('#kpi_filter_cluster_agent').append('<option value="SUMBAWA TIMUR">SUMBAWA TIMUR</option>');
    }else if($('#hidden-value-branch').text() =="MAGELANG"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="MAGELANG KOTA">MAGELANG KOTA</option>');
        $('#kpi_filter_cluster_agent').append('<option value="NEW KEBUMEN">NEW KEBUMEN</option>');
    }else if($('#hidden-value-branch').text() =="PEKALONGAN"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="NEW BATANG">NEW BATANG</option>');
        $('#kpi_filter_cluster_agent').append('<option value="TEGAL BREBES">TEGAL BREBES</option>');
    }else if($('#hidden-value-branch').text() =="PURWOKERTO"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="BANJARNEGARA">BANJARNEGARA</option>');
        $('#kpi_filter_cluster_agent').append('<option value="CILCAP MAS">CILCAP MAS</option>');
    }else if($('#hidden-value-branch').text() =="SEMARANG"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="DEMAK">DEMAK</option>');
        $('#kpi_filter_cluster_agent').append('<option value="JEPARA KUDUS">JEPARA KUDUS</option>');
        $('#kpi_filter_cluster_agent').append('<option value="PATI">PATI</option>');
        $('#kpi_filter_cluster_agent').append('<option value="SEMARANG">SEMARANG</option>');
    }else if($('#hidden-value-branch').text() =="SURAKARTA"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="BOYOLALI">BOYOLALI</option>');
        $('#kpi_filter_cluster_agent').append('<option value="SRAGEN">SRAGEN</option>');
        $('#kpi_filter_cluster_agent').append('<option value="SURAKARTA">SURAKARTA</option>');
    }else if($('#hidden-value-branch').text() =="YOGYAKARTA"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="DAERAH ISTIMEWA YOGYAKARTA">DAERAH ISTIMEWA YOGYAKARTA</option>');
    }else if($('#hidden-value-branch').text() =="JEMBER"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="BANYUWANGI">BANYUWANGI</option>');
        $('#kpi_filter_cluster_agent').append('<option value="JEMBER">JEMBER</option>');
        $('#kpi_filter_cluster_agent').append('<option value="KOTA PROBOLINGGO">KOTA PROBOLINGGO</option>');
        $('#kpi_filter_cluster_agent').append('<option value="SITUBONDO">SITUBONDO</option>');
    }else if($('#hidden-value-branch').text() =="LAMONGAN"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="LAMONGAN GRESIK">LAMONGAN GRESIK</option>');
        $('#kpi_filter_cluster_agent').append('<option value="TUBAN BOJONEGORO">TUBAN BOJONEGORO</option>');
    }else if($('#hidden-value-branch').text() =="MADIUN"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="KEDIRI">KEDIRI</option>');
        $('#kpi_filter_cluster_agent').append('<option value="MADIUN">MADIUN</option>');
        $('#kpi_filter_cluster_agent').append('<option value="PONOROGO">PONOROGO</option>');
    }else if($('#hidden-value-branch').text() =="MALANG"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="MALANG">MALANG</option>');
        $('#kpi_filter_cluster_agent').append('<option value="TULUNGAGUNG">TULUNGAGUNG</option>');
    }else if($('#hidden-value-branch').text() =="SIDOARJO"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="JOMBANG MOJOKERTO">JOMBANG MOJOKERTO</option>');
        $('#kpi_filter_cluster_agent').append('<option value="SIDOARJO PASURUAN">SIDOARJO PASURUAN</option>');
    }else if($('#hidden-value-branch').text() =="SURABAYA"){
        $('#kpi_filter_cluster_agent').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_agent').append('<option value="KOTA SURABAYA">KOTA SURABAYA</option>');
        $('#kpi_filter_cluster_agent').append('<option value="MADURA">MADURA</option>');
    }

</script>

<?php $this->endSection() ?>