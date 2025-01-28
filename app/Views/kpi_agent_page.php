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
                                    <a href="<?php echo esc(base_url('dashboard')); ?>" class="back-btn">
                                        <i class="fa-regular fa-circle-left float-start" style="font-size: 25px;padding-top: 2px;margin-right: 10px;"></i>
                                    </a>
                                    <h4 class="dark-blue-text">KPI</h4>
                                    <div style="clear: both;"></div>
                                    <span class="sub-title">last update : <?php echo esc($last_update_date); ?></span>
                                </div>
                                <div class="filter_wrapper mt-4">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-12 mb-3">
                                            <div id="hidden-value-branch" name="hidden-value-branch" style="display: none;"><?php echo esc($agent_branch); ?></div>
                                            <?php if($user_level == 'agent_branch'){ ?>
                                                <form method="post" action="<?php echo esc(base_url()."kpi"); ?>" enctype="multipart/form-data">
                                                    <?php csrf_field() ?>
                                                    <div class="row no-gutters">
                                                        <div class="form-group col-md-2 col-4 no-pad-right" id="col_periode_data">
                                                            <div class="input-group dropdown_input">
                                                                <input required type="text" class="monthPicker form-control pull-left txt-input-data" id="periode_data" name="periode_data_kpi_agent" value="<?php echo esc($display_periode); ?>" />
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-2 col-5 no-pad-right" id="wrap_kip_filter_cluster">
                                                            <select name='kpi_filter_cluster_agent' id='kpi_filter_cluster_agent' class="select_filter" title="Area Type" style="width:100%;">
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2 col-3">			
                                                            <input type="submit" id="btn_submit_periode_kip" name="btn_submit_periode_kpi_agent" value="GO" class="submit_btn_datepicker border_rad1" style="float:left;">
                                                        </div>
                                                        <?php if($show_fd == 1){ ?>
                                                        <p class="flashdata_error"><?= session()->getFlashdata('table_not_exists'); ?></p>
                                                         <?php } ?>
                                                        
                                                        <div style="clear: both;"></div>
                                                    </div>
                                                </form>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-group-wrapper">

                                    <div class="container-fluid p-0 mt-3">
                                        <div class="row">
                                            <div class="col-lg-3 mb-4">
                                                <h6>LEADERBOARD</h6>
                                                <div class="row">
                                                    <div class="col-12" style="padding-bottom: 16px;">
                                                        <span class="sub-title-table mt-2">BRANCH <?php echo $agent_branch ?></span>
                                                    </div>
                                                </div>
                                                
                                                <table class="table table-bordered table-custom">
                                                    <thead>
                                                        <tr class="bg-tb-blue">
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
                                                                    <?php }else if($row['runrate_status'] == "BLW"){ ?>
                                                                        class="text-center bw-bg"
                                                                    <?php } ?>
                                                                ><?php echo $row['runrate_status']; ?></th>
                                                            </tr>
                                                            
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h6 class="mb-0">SUMMARY</h6>
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <div class="row">
                                                        <div class="col-lg-7 col-md-6 col-sm-12 mb-3 mb-md-0" style="padding-top: 10px;">
                                                            <span class="sub-title-table">
                                                                <?php if($user_level == 'agent_branch'){ ?>
                                                                    <?php if($hidden_cluster == NULL){ ?>
                                                                    BRANCH <?php echo $agent_branch; ?>
                                                                    <?php }else{ ?>
                                                                    CLUSTER <?php echo $hidden_cluster; ?>
                                                                    <?php } ?>
                                                                <?php }else{ ?>
                                                                    CLUSTER <?php echo $agent_cluster; ?>
                                                                <?php } ?>
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="d-inline-block col-lg-5 col-md-6 col-sm-12 text-end">
                                                            <div class="row">
                                                                <div class="col-8">
                                                                    <div class="input-group">
                                                                        <input required type="text" id="searchInput" class="form-control txt-input-data" placeholder="Search..."  onkeyup="filterTable()">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4" style="padding-left: 0px;">
                                                                    <button id="exportCsv" class="submit_btn border_rad1" style="width: 100%;">DOWNLOAD</button>
                                                                </div>
                                                                <!--<div class="col-4" style="padding-left: 0px;">
                                                                    <?php if($user_level == 'agent_branch'){ ?>
                                                                        <form method="post" action="<?php echo base_url()."kpi/download_data_agent_branch"; ?>" enctype="multipart/form-data">
                                                                            <div style="padding-right:0px;">
                                                                                <input type="submit" id="btn_dl_data_agent" name="btn_dl_data_agent" value="download" class="submit_btn border_rad1" style="width: 100%;"></input>
                                                                                <input type="hidden" name="hidden_cluster" style="display: none;" value="<?php echo $hidden_cluster; ?>"></input>
                                                                                <input type="hidden" name="hidden_periode_kpi" style="display: none;" value="<?php echo $display_periode; ?>"></input>
                                                                            </div>
                                                                        </form>
                                                                    <?php }else{ ?>
                                                                        <form method="post" action="<?php echo base_url()."kpi/download_data_agent_cluster"; ?>" enctype="multipart/form-data">
                                                                            <div style="padding-right:0px;">
                                                                                <input type="submit" id="btn_dl_data_agent" name="btn_dl_data_agent" value="download" class="submit_btn border_rad1" style="width: 100%;"></input>
                                                                                <input type="hidden" name="hidden_cluster" style="display: none;" value="<?php echo $hidden_cluster; ?>"></input>
                                                                                <input type="hidden" name="hidden_periode_kpi" style="display: none;" value="<?php echo $display_periode; ?>"></input>
                                                                            </div>
                                                                        </form>
                                                                    <?php } ?>
                                                                </div>-->
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <div class="table-wrapper-scroll-y table-scroll-y">
                                                    <div class="table-top-scroll">
                                                        <div class="table-scroll-bar"></div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table id="dataTable" class="table table-bordered table-hover table-custom">
                                                            <thead>
                                                                <tr><th class="bg-tb-blue" rowspan="3" scope="col">No</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Regional</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Branch</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Cluster</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">City</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Agent ID</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">LinkAja</th>
                                                                    <th class="bg-tb-blue custom-width-large" rowspan="3" scope="col">DSS Name</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Digipos ID</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Active Date</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Inactive Date</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Level Competition</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">City War Profile</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Final ACH</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Runrate</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Class May'23</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Class Jun'23</th>
                                                                    <th class="bg-tb-blue custom-width" rowspan="3" scope="col">Class</th>
                                                                    <th class="table-dark-blue" colspan="26" scope="col">Performance Based</th>
                                                                    <th class="table-grey" rowspan="3" scope="col">Sub Bobot (70%)</th>
                                                                    <th class="bg-tb-blue" colspan="15" scope="col">Operational Based</th>
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
                                                                    <th class="bg-tb-blue" colspan="4" scope="col">PJP School Campus</th>
                                                                    <th class="table-grey" rowspan="2" scope="col">Bobot</th>
                                                                    <th class="bg-tb-blue" colspan="4" scope="col">Event Productivity</th>
                                                                    <th class="table-grey" rowspan="2" scope="col">Bobot</th>
                                                                    <th class="bg-tb-blue" colspan="4" scope="col">Campaign Sosmed</th>
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
                                                                        <th class="bg-tb-blue" scope="col">Target</th>
                                                                        <th class="bg-tb-blue" scope="col">Actual</th>
                                                                        <th class="bg-tb-blue" scope="col">Ach</th>
                                                                        <th class="bg-tb-blue" scope="col">Runrate</th>
                                                                    <?php } ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="dataTable_body_filter">
                                                                <tr style="visibility: collapse;">
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Regional</th>
                                                                    <th scope="col">Branch</th>
                                                                    <th scope="col">Cluster</th>
                                                                    <th scope="col">City</th>
                                                                    <th scope="col">Agent ID</th>
                                                                    <th scope="col">LinkAja</th>
                                                                    <th scope="col">DSS Name</th>
                                                                    <th scope="col">Digipos ID</th>
                                                                    <th scope="col">Active Date</th>
                                                                    <th scope="col">Inactive Date</th>
                                                                    <th scope="col">Level Competition</th>
                                                                    <th scope="col">City War Profile</th>
                                                                    <th scope="col">Final ACH</th>
                                                                    <th scope="col">Runrate</th>
                                                                    <th scope="col">Class May'23</th>
                                                                    <th scope="col">Class Jun'23</th>
                                                                    <th scope="col">Class</th>
                                                                    <th scope="col">New Sales SO</th>
                                                                    <th scope="col">New Sales SO Target</th>
                                                                    <th scope="col">New Sales SO Actual</th>
                                                                    <th scope="col">New Sales SO Prepaid</th>
                                                                    <th scope="col">New Sales SO ByU</th>
                                                                    <th scope="col">New Sales SO Ach</th>
                                                                    <th scope="col">New Sales SO Runrate</th>
                                                                    <th scope="col">New Sales SO Bobot</th>
                                                                    <th scope="col">New Sales SO</th>
                                                                    <th scope="col">New Sales New Imei Target</th>
                                                                    <th scope="col">New Sales New Imei Actual</th>
                                                                    <th scope="col">New Sales New Imei Prepaid</th>
                                                                    <th scope="col">New Sales New Imei ByU</th>
                                                                    <th scope="col">New Sales New Imei Ach</th>
                                                                    <th scope="col">New Sales New Imei Runrate</th>
                                                                    <th scope="col">New Sales New Imei Bobot</th>
                                                                    <th scope="col">Digital Transaction Target</th>
                                                                    <th scope="col">Digital Transaction Actual</th>
                                                                    <th scope="col">Digital Transaction Ach</th>
                                                                    <th scope="col">Digital Transaction Runrate</th>
                                                                    <th scope="col">Digital Transaction Bobot</th>
                                                                    <th scope="col">MyTsel New Installer Target</th>
                                                                    <th scope="col">MyTsel New Installer Actual</th>
                                                                    <th scope="col">MyTsel New Installer Ach</th>
                                                                    <th scope="col">MyTsel New Installer Runrate</th>
                                                                    <th scope="col">MyTsel New Installer Bobot</th>
                                                                    <th scope="col">Performance based Sub Bobot (70%)</th>
                                                                    <th scope="col">PJP School Campus Target</th>
                                                                    <th scope="col">PJP School Campus Actual</th>
                                                                    <th scope="col">PJP School Campus Ach</th>
                                                                    <th scope="col">PJP School Campus Runrate</th>
                                                                    <th scope="col">PJP School Campus Bobot</th>
                                                                    <th scope="col">Event Productivity Target</th>
                                                                    <th scope="col">Event Productivity Actual</th>
                                                                    <th scope="col">Event Productivity Ach</th>
                                                                    <th scope="col">Event Productivity Runrate</th>
                                                                    <th scope="col">Event Productivity Bobot</th>
                                                                    <th scope="col">Campaign Sosmed Target</th>
                                                                    <th scope="col">Campaign Sosmed Actual</th>
                                                                    <th scope="col">Campaign Sosmed Ach</th>
                                                                    <th scope="col">Campaign Sosmed Runrate</th>
                                                                    <th scope="col">Campaign Sosmed Bobot</th>
                                                                    <th scope="col">Sub Bobot (30%)</th>
                                                                </tr>
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
    
                                                                        <td class="text-center"><?php echo $row['final_ach'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['runrate'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['class_may_23'] ?></td>
                                                                        <td class="text-center"><?php echo $row['class_jun_23'] ?></td>
    
                                                                        <td class="text-center"><?php echo $row['class'] ?></td>
                                                                        <td class="text-center"><?php echo $row['new_sales'] ?></td>
                                                                        <td class="text-center"><?php echo $row['so_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['so_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['so_prepaid'] ?></td>
                                                                        <td class="text-center"><?php echo $row['so_byu'] ?></td>
                                                                        <td class="text-center"><?php echo $row['so_ach'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['so_runrate'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['so_bobot'] ?>%</td>
    
                                                                        <td class="text-center"><?php echo $row['imei_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['imei_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['imei_prepaid'] ?></td>
                                                                        <td class="text-center"><?php echo $row['imei_byu'] ?></td>
                                                                        <td class="text-center"><?php echo $row['imei_ach'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['imei_runrate'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['imei_bobot'] ?>%</td>
    
                                                                        <td class="text-center"><?php echo $row['dt_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['dt_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['dt_ach'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['dt_runrate'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['dt_bobot'] ?>%</td>
    
                                                                        <td class="text-center"><?php echo $row['mni_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['mni_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['mni_ach'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['mni_runrate'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['mni_bobot'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['pb_sub_bobot'] ?>%</td>
    
                                                                        <td class="text-center"><?php echo $row['rsc_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['rsc_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['rsc_ach'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['rsc_runrate'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['rsc_bobot'] ?>%</td>
    
                                                                        <td class="text-center"><?php echo $row['ep_plan'] ?></td>
                                                                        <td class="text-center"><?php echo $row['ep_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['ep_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['ep_ach'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['ep_runrate'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['ep_bobot'] ?>%</td>
    
                                                                        <td class="text-center"><?php echo $row['cs_target'] ?></td>
                                                                        <td class="text-center"><?php echo $row['cs_actual'] ?></td>
                                                                        <td class="text-center"><?php echo $row['cs_ach'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['cs_runrate'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['cs_bobot'] ?>%</td>
                                                                        <td class="text-center"><?php echo $row['ob_sub_bobot'] ?>%</td>
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

    function filterTable() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toLowerCase();
        const table = document.getElementById("dataTable_body_filter");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let match = false;
            
            for (let j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    const textValue = cells[j].textContent || cells[j].innerText;
                    if (textValue.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }
            
            rows[i].style.display = match ? "" : "none";
        }
    }

    $('#exportCsv').click(function () {
        // Function to export table to CSV
        // function exportTableToCSV(filename) {
        //     var csv = [];
        //     var rows = $('#dataTable tbody').find('tr');

        //     rows.each(function () {
        //         var row = [];
        //         $(this).find('th, td').each(function () {
        //             // Wrap content in double quotes to handle commas within cells
        //             row.push('"' + $(this).text().trim() + '"');
        //         });
        //         csv.push(row.join(','));
        //     });

        //     // Create a blob with the CSV content
        //     var csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });

        //     // Create a download link
        //     var downloadLink = document.createElement('a');
        //     downloadLink.download = filename;
        //     downloadLink.href = window.URL.createObjectURL(csvFile);
        //     downloadLink.style.display = 'none';

        //     // Append the link and trigger the download
        //     document.body.appendChild(downloadLink);
        //     downloadLink.click();
        //     document.body.removeChild(downloadLink);
        // }

        function exportTableToCSV(filename) {
            var csv = [];
            var rows = $('#dataTable tbody').find('tr');

            rows.each(function () {
                var row = [];
                $(this).find('th, td').each(function () {
                    // Bungkus isi sel dengan tanda kutip ganda untuk menangani koma dalam sel
                    row.push('"' + $(this).text().trim() + '"');
                });
                csv.push(row.join(','));
            });

            var csvContent = csv.join("\n");
            var blob = new Blob([csvContent], { type: "text/csv" });

            // Deteksi apakah dijalankan di Android atau browser
            if (window.Android && typeof window.Android.downloadCSV === 'function') {
                // Android: Kirim data melalui JavaScriptInterface
                var reader = new FileReader();
                reader.onload = function () {
                    window.Android.downloadCSV(reader.result, filename);
                };
                reader.readAsText(blob);
            } else {
                // Browser: Gunakan mekanisme unduh standar
                var downloadLink = document.createElement('a');
                downloadLink.href = URL.createObjectURL(blob);
                downloadLink.download = filename;
                downloadLink.style.display = 'none';

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }
        }

        // function exportTableToCSV(filename) {
        //     var csv = [];
        //     var rows = document.querySelectorAll("#dataTable tbody tr");

        //     rows.forEach(function (row) {
        //         var rowData = [];
        //         row.querySelectorAll("th, td").forEach(function (cell) {
        //             rowData.push('"' + cell.textContent.trim() + '"');
        //         });
        //         csv.push(rowData.join(","));
        //     });

        //     var csvContent = csv.join("\n");

        //     // Buat Blob
        //     var blob = new Blob([csvContent], { type: "text/csv" });

        //     // Gunakan Fetch API untuk mengunduh
        //     fetch(URL.createObjectURL(blob))
        //         .then((res) => res.blob())
        //         .then((blob) => {
        //             // Simpan Blob ke Android menggunakan JavaScriptInterface
        //             window.Android.downloadCSV(blob, filename);
        //         });
        // }


        // Call the function with a file name
        const dateformat = new Date().toISOString().replace(/[-:.TZ]/g, '').slice(0, 14); // Format YYYYMMDDHHMMSS
        const exported_fname = `table_export_${dateformat}.csv`;
        exportTableToCSV(exported_fname);

    });

    $('.table-scroll-bar').width($('#dataTable').outerWidth());

    // Synchronize scrolling
    $('.table-top-scroll').on('scroll', function () {
        $('.table-responsive').scrollLeft($(this).scrollLeft());
    });

    $('.table-responsive').on('scroll', function () {
        $('.table-top-scroll').scrollLeft($(this).scrollLeft());
    });
</script>

<?php $this->endSection() ?>