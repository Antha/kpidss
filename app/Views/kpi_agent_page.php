<?php $this->extend('template_header_menu_page') ?>

<?php $this->section('content') ?>

<body>
    <div class="dashboard-page">
        
        <div class="sidebar w3-bar-block w3-card animate-left" style="display:none" id="mySidebar">
            <div class="close-nav-btn-wrapper">
                <button class="btn close-nav-btn" onclick="w3_close()">&times;</button>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link active" aria-current="page" href="#">PNP TEST</a>
                <a class="nav-link" href="#">KPI</a>
                <a class="nav-link" href="#">LOYALTY</a>
            </nav>  
        </div>

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
                                <?php $this->include('include_header_top') ?>
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
                                    <h4 class="red-text">KPI</h4>
                                    <span>last update : <?php echo $last_update_date; ?></span>
                                </div>
                                <div class="filter_wrapper mt-4">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-12 mb-3">
                                            <div id="hidden-value-branch" style="display: none;"><?php echo $agent_branch; ?></div>
                                            <form method="post" action="<?php echo base_url()."kpi"; ?>" enctype="multipart/form-data">
                                                <div class="row no-gutters">
                                                    <div class="form-group col-md-2 col-4 no-pad-right" id="col_periode_data">
                                                        <div class="input-group dropdown_input">
                                                            <input required type="text" class="monthPicker form-control pull-left txt-input-data" id="periode_data" name="periode_data_kpi_admin" value="<?php echo $display_periode; ?>" />
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-2 col-3 no-pad-right" id="wrap_kip_filter_cluster">
                                                        <select name='kpi_filter_cluster_agent' id='kpi_filter_cluster_agent' class="select_filter" title="Area Type" style="width:100%;">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-2">			
                                                        <input type="submit" id="btn_submit_periode_kip" name="btn_submit_periode_kip_agent" value="GO" class="submit_btn_datepicker border_rad1" style="float:left;">
                                                    </div>
                                                    <p class="flashdata_error"><?= session()->getFlashdata('table_not_exists'); ?></p> 
                                                    
                                                    <div style="clear: both;"></div>
                                                </div>
                                            </form>
                                        </div>
                                        <!--<div class="col-lg-3 col-sm-3 col-md-3 col-3">
                                            <div class="input-group">
                                                <input required type="text" id="search" class="form-control txt-input-data" placeholder="Search...">
                                                <div class="input-group-addon">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </div>
                                            </div>
                                        </div>-->
                                    </div>
                                </div>
                                <div class="table-group-wrapper">

                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h6>LEADERBOARD</h6>
                                                <table class="table table-bordered table-custom">
                                                    <thead>
                                                        <tr class="bg-danger">
                                                            <th scope="col">RANK</th>
                                                            <th scope="col">DSS NAME</th>
                                                            <th scope="col">RUNRATE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="normal-fw">
                                                        <?php foreach($kpi_leaderboard as $row) {?>
                                                            <tr>
                                                                <th rowspan="2" class="text-center align-middle" scope="row">
                                                                    <?php echo $row['rank']; ?>
                                                                </th>
                                                                <th><?php echo $row['dss_name']; ?></th>
                                                                <th class="text-center"><?php echo $row['runrate']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th><?php echo $row['cluster']; ?></th>
                                                                <th <?php if($row['runrate_status'] == "EXC"){?> 
                                                                                    class="text-center exc-bg"
                                                                                <?php }else if($row['runrate_status'] == "OTT"){ ?>
                                                                                    class="text-center ott-bg"
                                                                                <?php }else if($row['runrate_status'] == "BW"){ ?>
                                                                                    class="text-center bw-bg"
                                                                                <?php } ?>
                                                                            ><?php echo $row['runrate_status']; ?></th>
                                                            </tr>
                                                            
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h6 style="display: inline-block;">SUMMARY</h6>
                                                        <div class="download-icon-wrapper" style="float: right;margin-top: -15px;padding-right:0px;">
                                                            <a href="#" title="DOWNLOAD CSV">
                                                                <i class="fa-solid fa-file-arrow-down"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="table-wrapper-scroll-y table-scroll-y">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-hover table-custom">
                                                            <thead>
                                                                <tr><th class="bg-danger" rowspan="3" scope="col">No</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Regional</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Branch</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Cluster</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">City</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Agent ID</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">LinkAja</th>
                                                                    <th class="bg-danger custom-width-large" rowspan="3" scope="col">DSS Name</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Digipos ID</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Active Date</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Inactive Date</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Level Competition</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">City War Profile</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Final ACH</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Runrate</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Class May'23</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Class Jun'23</th>
                                                                    <th class="bg-danger custom-width" rowspan="3" scope="col">Class</th>
                                                                    <th class="table-dark-blue" colspan="26" scope="col">Performance Based</th>
                                                                    <th class="table-grey" rowspan="3" scope="col">Sub Bobot (70%)</th>
                                                                    <th class="bg-danger" colspan="15" scope="col">Operational Based</th>
                                                                    <th class="table-grey" rowspan="3" scope="col">Sub Bobot (30%)</th>
                                                                    
                                                                </tr>
                                                                <tr>
                                                                    <th class="table-grey" rowspan="2" scope="col">New Sales</th>
                                                                    <th class="table-dark-blue" colspan="6" scope="col">New Sales To SO</th>
                                                                    <th class="table-grey" rowspan="2" scope="col">Bobot</th>
                                                                    <th class="table-grey" rowspan="2" scope="col">New Sales</th>
                                                                    <th class="table-dark-blue" colspan="6" scope="col">New Sales To NEW IMEI</th>
                                                                    <th class="table-grey" rowspan="2" scope="col">Bobot</th>
                                                                    <th class="table-dark-blue" colspan="4" scope="col">Digital Transaction</th>
                                                                    <th class="table-grey" rowspan="2" scope="col">Bobot</th>
                                                                    <th class="table-dark-blue" colspan="4" scope="col">MyTsel New Installer</th>
                                                                    <th class="table-grey" rowspan="2" scope="col">Bobot</th>
                                                                    <th class="bg-danger" colspan="4" scope="col">PJP School Campus</th>
                                                                    <th class="table-grey" rowspan="2" scope="col">Bobot</th>
                                                                    <th class="bg-danger" colspan="4" scope="col">Event Productivity</th>
                                                                    <th class="table-grey" rowspan="2" scope="col">Bobot</th>
                                                                    <th class="bg-danger" colspan="4" scope="col">Campaign Sosmed</th>
                                                                    <th class="table-grey" rowspan="2" scope="col">Bobot</th>
                                                                </tr>
                                                                <tr>
                                                                    <?php for($i=1;$i<=2;$i++){ ?>
                                                                        <th class="table-dark-blue" scope="col">Target</th>
                                                                        <th class="table-dark-blue" scope="col">Actual</th>
                                                                        <th class="table-dark-blue" scope="col">Prepaid</th>
                                                                        <th class="table-dark-blue" scope="col">ByU</th>
                                                                        <th class="table-dark-blue" scope="col">Ach</th>
                                                                        <th class="table-dark-blue" scope="col">Runrate</th>
                                                                    <?php } ?>
                                                                    <?php for($i=1;$i<=2;$i++){ ?>
                                                                        <th class="table-dark-blue" scope="col">Target</th>
                                                                        <th class="table-dark-blue" scope="col">Actual</th>
                                                                        <th class="table-dark-blue" scope="col">Ach</th>
                                                                        <th class="table-dark-blue" scope="col">Runrate</th>
                                                                    <?php } ?>
                                                                    <?php for($i=1;$i<=3;$i++){ ?>
                                                                        <th class="bg-danger" scope="col">Target</th>
                                                                        <th class="bg-danger" scope="col">Actual</th>
                                                                        <th class="bg-danger" scope="col">Ach</th>
                                                                        <th class="bg-danger" scope="col">Runrate</th>
                                                                    <?php } ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i=1;foreach($kpi_data as $row){?>
                                                                    <tr <?php if($agent_id == $row['agent_id']){ ?>style="background-color: #e5e5e5;"<?php } ?>>
                                                                        <td class="text-center"><?php echo $i; ?></td>
                                                                        <td><?php echo $row['regional'] ?></td>
                                                                        <td><?php echo $row['branch'] ?></td>
                                                                        <td><?php echo $row['cluster'] ?></td>
                                                                        <td><?php echo $row['city'] ?></td>
    
                                                                        <td class="text-center"><?php echo $row['agent_id'] ?></td>
                                                                        <td class="text-center"><?php echo $row['linkaja'] ?></td>
                                                                        <td><?php echo $row['dss_name'] ?></td>
                                                                        <td class="text-center"><?php echo $row['digipos_id'] ?></td>
    
                                                                        <td class="text-center"><?php echo $row['active_date'] ?></td>
                                                                        <td class="text-center"><?php echo $row['inactive_date'] ?></td>
                                                                        <td class="text-center"><?php echo $row['level_competition'] ?></td>
                                                                        <td class="text-center"><?php echo $row['city_war_profile'] ?></td>
    
                                                                        <td class="text-center"><?php echo $row['final_ach'] ?></td>
                                                                        <td class="text-center"><?php echo $row['runrate'] ?></td>
                                                                        <td class="text-center"><?php echo $row['class_may_23'] ?></td>
                                                                        <td class="text-center"><?php echo $row['class_jun_23'] ?></td>
    
                                                                        <td class="text-center"><?php echo $row['class'] ?></td>
                                                                        <td class="text-center"><?php echo $row['new_sales'] ?></td>
                                                                        <td class="text-center"><?php echo $row['so_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['so_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['so_prepaid'] ?></td>
                                                                        <td class="text-center"><?php echo $row['so_byu'] ?></td>
                                                                        <td class="text-center"><?php echo $row['so_ach'] ?></td>
                                                                        <td class="text-center"><?php echo $row['so_runrate'] ?></td>
                                                                        <td class="text-center"><?php echo $row['so_bobot'] ?></td>
    
                                                                        <td class="text-center"><?php echo $row['imei_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['imei_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['imei_prepaid'] ?></td>
                                                                        <td class="text-center"><?php echo $row['imei_byu'] ?></td>
                                                                        <td class="text-center"><?php echo $row['imei_ach'] ?></td>
                                                                        <td class="text-center"><?php echo $row['imei_runrate'] ?></td>
                                                                        <td class="text-center"><?php echo $row['imei_bobot'] ?></td>
    
                                                                        <td class="text-center"><?php echo $row['dt_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['dt_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['dt_ach'] ?></td>
                                                                        <td class="text-center"><?php echo $row['dt_runrate'] ?></td>
                                                                        <td class="text-center"><?php echo $row['dt_bobot'] ?></td>
    
                                                                        <td class="text-center"><?php echo $row['mni_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['mni_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['mni_ach'] ?></td>
                                                                        <td class="text-center"><?php echo $row['mni_runrate'] ?></td>
                                                                        <td class="text-center"><?php echo $row['mni_bobot'] ?></td>
                                                                        <td class="text-center"><?php echo $row['pb_sub_bobot'] ?></td>
    
                                                                        <td class="text-center"><?php echo $row['rsc_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['rsc_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['rsc_ach'] ?></td>
                                                                        <td class="text-center"><?php echo $row['rsc_runrate'] ?></td>
                                                                        <td class="text-center"><?php echo $row['rsc_bobot'] ?></td>
    
                                                                        <td class="text-center"><?php echo $row['ep_plan'] ?></td>
                                                                        <td class="text-center"><?php echo $row['ep_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['ep_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['ep_ach'] ?></td>
                                                                        <td class="text-center"><?php echo $row['ep_runrate'] ?></td>
                                                                        <td class="text-center"><?php echo $row['ep_bobot'] ?></td>
    
                                                                        <td class="text-center"><?php echo $row['cs_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['cs_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['cs_ach'] ?></td>
                                                                        <td class="text-center"><?php echo $row['cs_runrate'] ?></td>
                                                                        <td class="text-center"><?php echo $row['cs_bobot'] ?></td>
                                                                        <td class="text-center"><?php echo $row['ob_sub_bobot'] ?></td>
                                                                    </tr>
                                                                <?php $i++;} ?>
                                                                
                                                            </tbody>
                                                        </table>
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

        <div id="footer" style="margin-top: 50px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center p-3 footer-wrapper">
                        <span>Copyright © 2025. All rights reserved by FROSTBURN</span>
                    </div>
                </div>
            </div>
        </div>
           
    </div>
</body>

<link rel="stylesheet" href="<?php echo base_url('/css/datepicker.css') ?>">
<script type="text/javascript" src="<?php echo base_url('/script/bootstrap-datepicker.js') ?>"></script>
<script>
    function w3_open() {
    document.getElementById("main").style.marginLeft = "25%";
    document.getElementById("mySidebar").style.width = "25%";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("openNav").style.display = 'none';
    }
    function w3_close() {
    document.getElementById("main").style.marginLeft = "0%";
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

    console.log($('#hidden-value-branch').text());
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
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="KUPANG ROTE">KUPANG ROTE</option>');
        $('#kpi_filter_cluster_admin').append('<option value="MALAKA TIMTIM BELU">MALAKA TIMTIM BELU</option>');
        $('#kpi_filter_cluster_admin').append('<option value="SUMBA">SUMBA</option>');
    }else if($('#hidden-value-branch').text() =="MATARAM"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="LOMBOK">LOMBOK</option>');
        $('#kpi_filter_cluster_admin').append('<option value="SUMBAWA BARAT">SUMBAWA BARAT</option>');
        $('#kpi_filter_cluster_admin').append('<option value="SUMBAWA TIMUR">SUMBAWA TIMUR</option>');
    }else if($('#hidden-value-branch').text() =="MAGELANG"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="MAGELANG KOTA">MAGELANG KOTA</option>');
        $('#kpi_filter_cluster_admin').append('<option value="NEW KEBUMEN">NEW KEBUMEN</option>');
    }else if($('#hidden-value-branch').text() =="PEKALONGAN"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="NEW BATANG">NEW BATANG</option>');
        $('#kpi_filter_cluster_admin').append('<option value="TEGAL BREBES">TEGAL BREBES</option>');
    }else if($('#hidden-value-branch').text() =="PURWOKERTO"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="BANJARNEGARA">BANJARNEGARA</option>');
        $('#kpi_filter_cluster_admin').append('<option value="CILCAP MAS">CILCAP MAS</option>');
    }else if($('#hidden-value-branch').text() =="SEMARANG"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="DEMAK">DEMAK</option>');
        $('#kpi_filter_cluster_admin').append('<option value="JEPARA KUDUS">JEPARA KUDUS</option>');
        $('#kpi_filter_cluster_admin').append('<option value="PATI">PATI</option>');
        $('#kpi_filter_cluster_admin').append('<option value="SEMARANG">SEMARANG</option>');
    }else if($('#hidden-value-branch').text() =="SURAKARTA"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="BOYOLALI">BOYOLALI</option>');
        $('#kpi_filter_cluster_admin').append('<option value="SRAGEN">SRAGEN</option>');
        $('#kpi_filter_cluster_admin').append('<option value="SURAKARTA">SURAKARTA</option>');
    }else if($('#hidden-value-branch').text() =="YOGYAKARTA"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="DAERAH ISTIMEWA YOGYAKARTA">DAERAH ISTIMEWA YOGYAKARTA</option>');
    }else if($('#hidden-value-branch').text() =="JEMBER"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="BANYUWANGI">BANYUWANGI</option>');
        $('#kpi_filter_cluster_admin').append('<option value="JEMBER">JEMBER</option>');
        $('#kpi_filter_cluster_admin').append('<option value="KOTA PROBOLINGGO">KOTA PROBOLINGGO</option>');
        $('#kpi_filter_cluster_admin').append('<option value="SITUBONDO">SITUBONDO</option>');
    }else if($('#hidden-value-branch').text() =="LAMONGAN"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="LAMONGAN GRESIK">LAMONGAN GRESIK</option>');
        $('#kpi_filter_cluster_admin').append('<option value="TUBAN BOJONEGORO">TUBAN BOJONEGORO</option>');
    }else if($('#hidden-value-branch').text() =="MADIUN"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="KEDIRI">KEDIRI</option>');
        $('#kpi_filter_cluster_admin').append('<option value="MADIUN">MADIUN</option>');
        $('#kpi_filter_cluster_admin').append('<option value="PONOROGO">PONOROGO</option>');
    }else if($('#hidden-value-branch').text() =="MALANG"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="MALANG">MALANG</option>');
        $('#kpi_filter_cluster_admin').append('<option value="TULUNGAGUNG">TULUNGAGUNG</option>');
    }else if($('#hidden-value-branch').text() =="SIDOARJO"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="JOMBANG MOJOKERTO">JOMBANG MOJOKERTO</option>');
        $('#kpi_filter_cluster_admin').append('<option value="SIDOARJO PASURUAN">SIDOARJO PASURUAN</option>');
    }else if($('#hidden-value-branch').text() =="SURABAYA"){
        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        $('#kpi_filter_cluster_admin').append('<option value="KOTA SURABAYA">KOTA SURABAYA</option>');
        $('#kpi_filter_cluster_admin').append('<option value="MADURA">MADURA</option>');
    }

</script>

<?php $this->endSection() ?>