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
                                <div class="date-update-wrapper" style="width: 100%;">
                                    <a href="<?php echo base_url()."dashboard"?>" class="back-btn">
                                        <i class="fa-regular fa-circle-left float-start" style="font-size: 25px;padding-top: 2px;margin-right: 10px;"></i>
                                    </a>
                                    <h4 class="dark-blue-text">PNP TEST SUMMARY</h4>
                                    <span>last update : <?php echo $lastUpdateData; ?></span>
                                </div>
                                <div class="filter_wrapper mt-4">
                                    <div class="container-fluid">
                                        <form method="post"  action="<?php echo base_url()."pnp_test"; ?>" enctype="multipart/form-data" id="form_submit_date">
                                            <?php csrf_field() ?>
                                            <div class="row">
                                                <div class="form-group col-md-2 col-4 pe-0" id="col_periode_data">
                                                    <div class="input-group dropdown_input">
                                                        <input required type="text" class="monthPicker form-control pull-left txt-input-data" id="periode_data" name="periode_data_pnp_test" value="<?php echo $displayPeriode; ?>" style="padding: 8px 9px" />
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-2 col-4 pe-0 mb-3" id="wrap_filter_branch">
                                                    <select name='filter_branch_admin' id='filter_branch_admin' class="select_filter" title="Area Type" style="width:100%;">
                                                        <option value="" selected disabled>Branch</option>
                                                        <option value="ALL">ALL BRANCH</option>
                                                        <option value="DENPASAR">DENPASAR</option>
                                                        <option value="FLORES">FLORES</option>
                                                        <option value="KUPANG">KUPANG</option>
                                                        <option value="MATARAM">MATARAM</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2 col-4 pe-0 mb-3" id="wrap_filter_cluster">
                                                    <select name='filter_cluster_admin' id='filter_cluster_admin' class="select_filter" title="Area Type" style="width:100%;">
                                                        <option value="" selected disabled>Cluster</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2 col-4 pe-0 mb-3" id="wrap_filter_city">
                                                    <select name='filter_city_admin' id='filter_city_admin' class="select_filter" title="Area Type" style="width:100%;">
                                                        <option value="" selected disabled>City</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-3">			
                                                    <input type="submit" id="btn_submit_periode" name="submit_periode_data_pnp_test" value="GO" class="submit_btn_datepicker border_rad1" style="float:left;">
                                                </div>
                                                <p style="padding-left:5px;color:#00bd52;"><?= session()->getFlashdata('error_message'); ?></p> 
                                                <div style="clear: both;"></div>
                                            <div class="row">
                                        </form>
                                    </div>
                                    <div class="container-fluid additional-info-wrapper">
                                        <div class="row">
                                            <div class="col-md-2 pt-3">
                                                <i class="fa-solid fa-circle-info pe-1"></i>
                                                <span>DS Login : <?= $getDsLoginReport[0]['user_login']; ?></span>
                                            </div>
                                            <div class="col-md-2 pt-3">
                                                <i class="fa-solid fa-circle-info pe-1"></i>
                                                <span>DS Belum Login : <?= $getDsLoginReport[0]['user_belum_login']; ?></span>
                                            </div>
                                            <div class="col-md-2 pt-3">
                                                <i class="fa-solid fa-circle-info pe-1"></i>
                                                <span>Best DS : </span>
                                            </div>
                                            <div class="offset-md-3 col-md-2 col-8 pt-2">
                                                <div class="input-group">
                                                    <input type="text" id="searchInput" class="form-control txt-input-data" placeholder="Search..."  onkeyup="filterTable()">
                                                    <div class="input-group-addon">
                                                        <i class="fa-solid fa-magnifying-glass"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-md-2 col-4 download-icon-wrapper">
                                                <form method="post" action="<?php echo base_url()."pnp_test/download_test_result"; ?>" enctype="multipart/form-data">
                                                    <div class="download-btn-style1" style="padding-right:0px;">
                                                        <input type="submit" id="btn_dl_test_result" name="btn_dl_test_result" value="download" class="submit_btn border_rad1"></input>
                                                        <input type="hidden" name="periode_dl" id="periode_dl" value="<?php echo $displayPeriode; ?>">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="row">
                                        <div class="col-lg-2 col-sm-2 col-md-2 col-6">
                                            <form method="post"  action="<?php echo base_url()."pnp_test"; ?>" enctype="multipart/form-data" id="form_submit_date">
                                                <div class="row">
                                                    <div class="form-group col-md-8 col-8 no-pad-right" id="col_periode_data">
                                                        <div class="input-group dropdown_input">
                                                            <input required type="text" class="monthPicker form-control pull-left txt-input-data" id="periode_data" name="periode_data_pnp_test" value="<?php echo $displayPeriode; ?>" />
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-2 col-3 no-pad-right mb-3" id="wrap_filter_branch">
                                                        <select name='filter_branch_admin' id='filter_branch_admin' class="select_filter" title="Area Type" style="width:100%;">
                                                            <option value="" selected disabled>Branch</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2 col-3 no-pad-right mb-3" id="wrap_filter_cluster">
                                                        <select name='filter_cluster_admin' id='filter_cluster_admin' class="select_filter" title="Area Type" style="width:100%;">
                                                            <option value="" selected disabled>Cluster</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2 col-3 no-pad-right mb-3" id="wrap_filter_cluster">
                                                        <select name='filter_cluster_admin' id='filter_cluster_admin' class="select_filter" title="Area Type" style="width:100%;">
                                                            <option value="" selected disabled>City</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-4">			
                                                        <input type="submit" id="btn_submit_periode" name="submit_periode_data_pnp_test" value="GO" class="submit_btn_datepicker border_rad1" style="float:left;">
                                                    </div>
                                                    <p style="padding-left:5px;color:#00bd52;"><?= session()->getFlashdata('error_message'); ?></p> 
                                                    <div style="clear: both;"></div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-2 col-sm-2 col-md-2 col-6">
                                            <div class="input-group">
                                                <input required type="text" id="searchInput" class="form-control txt-input-data" placeholder="Search..."  onkeyup="filterTable()">
                                                <div class="input-group-addon">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-2 col-md-2 col-12 offset-lg-10 offset-md-10 download-icon-wrapper">
                                            <form method="post" action="<?php echo base_url()."pnp_test/download_test_result"; ?>" enctype="multipart/form-data">
                                                <div class="download-btn-style1" style="padding-right:0px;">
                                                    <input type="submit" id="btn_dl_test_result" name="btn_dl_test_result" value="download" class="submit_btn border_rad1"></input>
                                                    <input type="hidden" name="periode_dl" id="periode_dl" value="<?php echo $displayPeriode; ?>">
                                                </div>
                                            </form>
                                        </div>
                                    </div>-->
                                </div>
                                <div class="table-wrapper-scroll-y table-scroll-y">
                                    <div class="table-top-scroll">
                                        <div class="table-scroll-bar"></div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-custom" id="dataTable">
                                            <thead>
                                                <tr class="bg-tb-blue">
                                                    <th scope="col">Rank</th>
                                                    <th scope="col">Agent ID</th>
                                                    <th scope="col" style="min-width: 400px;">DSS Name</th>
                                                    <th scope="col">Branch</th>
                                                    <th scope="col" style="min-width: 200px;">Cluster</th>
                                                    <th scope="col" style="min-width: 200px;">City</th>
                                                    <th scope="col" style="min-width: 200px;">Test Date</th>
                                                    <th scope="col">Right Answer</th>
                                                    <th scope="col">Wrong Answer</th>
                                                    <th scope="col">Score</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Role</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($resumeResults)): ?>
                                                    <?php foreach ($resumeResults as $index => $result): ?>
                                                        <tr>
                                                            <td class="text-center"><?= $index + 1 ?></td>
                                                            <td><?= esc($result['Agent ID']) ?></td>
                                                            <td><?= esc($result['DSS Name']) ?></td>
                                                            <td><?= esc($result['branch']) ?></td>
                                                            <td><?= esc($result['cluster']) ?></td>
                                                            <td><?= esc($result['city']) ?></td>
                                                            <td class="text-center"><?= esc($result['datetime']) ?></td>
                                                            <td class="text-center"><?= esc($result['num_right']) ?></td>
                                                            <td class="text-center"><?= esc($result['num_wrong']) ?></td>
                                                            <td class="text-center"><?= esc($result['score']) ?></td>
                                                            <td><?= esc($result['status']) ?></td>
                                                            <td><?= esc($result['status']) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="9" class="text-center">No data available</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>

                                        <script>
                                            document.getElementById("form_submit_date").addEventListener("submit", function () {
                                                event.preventDefault(); // Mencegah refresh halaman

                                                const periode = document.getElementById("periode_data").value;
                                                const branch = document.getElementById("filter_branch_admin").value;
                                                const cluster = document.getElementById("filter_cluster_admin").value;
                                                const city = document.getElementById("filter_city_admin").value;

                                                const table = document.getElementById("dataTable");
                                                const rows = table.getElementsByTagName("tr");
                                                //const filter = document.getElementById("periode_data").value; // Value in 'ym' format
                                                //const table = document.getElementById("dataTable");
                                                //const rows = table.getElementsByTagName("tr");

                                                for (let i = 1; i < rows.length; i++) { // Skip the header row
                                                    const cells = rows[i].getElementsByTagName("td");
                                                    if (cells.length > 0) {
                                                        const testDate = cells[6]?.textContent.trim() || cells[6]?.innerText.trim();
                const testDateYM = testDate ? testDate.substring(0, 7).replace("-", "") : "";
                const rowBranch = cells[3]?.textContent.trim();
                const rowCluster = cells[4]?.textContent.trim();
                const rowCity = cells[5]?.textContent.trim();

                                                        // Apply filters
                                                        const matchPeriode = !periode || testDateYM === periode;
                                                        const matchBranch = !branch || rowBranch === branch;
                                                        const matchCluster = !cluster || rowCluster === cluster;
                                                        const matchCity = !city || rowCity === city;

                                                        // Show row if all conditions match, otherwise hide
                                                        rows[i].style.display = (matchPeriode && matchBranch && matchCluster && matchCity) ? "" : "none";
                                                        //const testDate = cells[4]?.textContent || cells[4]?.innerText; // Get 'Test Date' column value
                                                        //console.log(testDate);
                                                        //const testDateYM = testDate ? testDate.substring(0, 7).replace("-", "") : ""; // Extract 'ym' format

                                                        // Show row if it matches the filter; otherwise hide it
                                                        //rows[i].style.display = testDateYM === filter ? "" : "none";
                                                    }
                                                }
                                                
                                                //isi hidden input dengan nilai dari filter
                                                //$('#periode_dl').val(filter);
                                                document.getElementById('periode_dl').value = periode;
                                            });

                                            function filterTable() {
                                                const input = document.getElementById("searchInput");
                                                const filter = input.value.toLowerCase();
                                                const table = document.getElementById("dataTable");
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
                                        </script>
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
    $(document).ready(function() {
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

        $('.table-scroll-bar').width($('#dataTable').outerWidth());

        // Synchronize scrolling
        $('.table-top-scroll').on('scroll', function () {
            $('.table-responsive').scrollLeft($(this).scrollLeft());
        });

        $('.table-responsive').on('scroll', function () {
            $('.table-top-scroll').scrollLeft($(this).scrollLeft());
        });

        const clusterOptions = {
            "DENPASAR": ["BALI BARAT", "BALI TENGAH", "BALI TIMUR"],
            "FLORES": ["ENDE SIKKA", "FLORES TIMUR", "MANGGARAI"],
            "KUPANG": ["KUPANG ROTE", "MALAKA TIMTIM BELU", "SUMBA"],
            "MATARAM": ["LOMBOK", "SUMBAWA BARAT", "SUMBAWA TIMUR"]
        };

        $('#filter_branch_admin').on('change', function() {
            let branch = $(this).val();
            let clusterDropdown = $('#filter_cluster_admin');
            let cityDropdown = $('#filter_city_admin');
            
            clusterDropdown.html('<option value="" selected disabled>Cluster</option>');
            if(branch == 'ALL'){
                cityDropdown.html('<option value="" selected disabled>City</option>');
            }
        
            if (clusterOptions[branch]) {
                clusterOptions[branch].forEach(cluster => {
                    clusterDropdown.append(`<option value="${cluster}">${cluster}</option>`);
                });
            }
        
        });

        const cityOptions = {
            'BALI BARAT': ['BULELENG','JEMBRANA','TABANAN'],
            'BALI TENGAH': ['BADUNG','KOTA DENPASAR'],
            'BALI TIMUR': ['BANGLI','GIANYAR','KARANG ASEM','KLUNGKUNG'],
            'ENDE SIKKA': ['ENDE','SIKKA'],
            'FLORES TIMUR': ['ALOR','FLORES TIMUR','LEMBATA'],
            'KUPANG ROTE': ['KOTA KUPANG','KUPANG','ROTE NDAO'],
            'MALAKA TIMTIM BELU': ['BELU','MALAKA','TIMOR TENGAH SELATAN','TIMOR TENGAH UTARA'],
            'MANGGARAI': ['MANGGARAI','MANGGARAI BARAT','MANGGARAI TIMUR','NAGEKEO','NGADA'],
            'SUMBA': ['SABU RAIJUA','SUMBA BARAT','SUMBA BARAT DAYA','SUMBA TENGAH','SUMBA TIMUR'],
            'LOMBOK': ['KOTA MATARAM','LOMBOK BARAT','LOMBOK TENGAH','LOMBOK TIMUR','LOMBOK UTARA'],
            'SUMBAWA BARAT': ['SUMBAWA','SUMBAWA BARAT'],
            'SUMBAWA TIMUR': ['BIMA','DOMPU','KOTA BIMA'],
        };

        $('#filter_cluster_admin').on('change', function() {
            let cluster = $(this).val();
            let cityDropdown = $('#filter_city_admin');
            
            cityDropdown.html('<option value="" selected disabled>City</option>');
        
            if (cityOptions[cluster]) {
                cityOptions[cluster].forEach(city => {
                    cityDropdown.append(`<option value="${city}">${city}</option>`);
                });
            }
        
        });
    });
</script>

<?php $this->endSection() ?>