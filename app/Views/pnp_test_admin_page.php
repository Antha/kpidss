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
                                    <h4 class="red-text">PNP TEST SUMMARY</h4>
                                    <span>last update : 2025-01-09</span>
                                </div>
                                <div class="filter_wrapper mt-4">
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-2 col-md-2 col-5">
                                            <form method="post"  enctype="multipart/form-data" id="form_submit_date">
                                                <div class="row">
                                                <div class="form-group col-md-8 col-8 no-pad-right" id="col_periode_data">
                                                    <div class="input-group dropdown_input">
                                                        <input required type="text" class="monthPicker form-control pull-left txt-input-data" id="periode_data" name="periode_data_pnp_test" value="202501" />
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-4">			
                                                    <input type="submit" id="btn_submit_periode" name="" value="GO" class="submit_btn_datepicker border_rad1" style="float:left;">
                                                </div>
                                                <p style="padding-left:5px;color:#00bd52;"><?= session()->getFlashdata('error_message'); ?></p> 
                                                <div style="clear: both;"></div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-2 col-sm-2 col-md-2 col-5">
                                            <div class="input-group">
                                                <input required type="text" id="searchInput" class="form-control txt-input-data" placeholder="Search..."  onkeyup="filterTable()">
                                                <div class="input-group-addon">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-sm-2 col-md-2 col-2 offset-lg-6 offset-md-6 download-icon-wrapper">
                                            <a href="#">
                                                <i class="fa-solid fa-file-arrow-down"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-wrapper table-responsive table-scroll-y">
                                    <table class="table table-bordered table-hover table-custom" id="dataTable">
                                        <thead>
                                            <tr class="bg-danger">
                                                <th scope="col">No</th>
                                                <th scope="col">Agent ID</th>
                                                <th scope="col">Digipos ID</th>
                                                <th scope="col">DSS Name</th>
                                                <th scope="col">Test Date</th>
                                                <th scope="col">Right Answer</th>
                                                <th scope="col">Wrong Answer</th>
                                                <th scope="col">Score</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($resumeResults)): ?>
                                                <?php foreach ($resumeResults as $index => $result): ?>
                                                    <tr>
                                                        <td><?= $index + 1 ?></td>
                                                        <td><?= esc($result['Agent ID']) ?></td>
                                                        <td><?= esc($result['Digipos ID']) ?></td>
                                                        <td><?= esc($result['DSS Name']) ?></td>
                                                        <td><?= esc($result['datetime']) ?></td>
                                                        <td><?= esc($result['num_right']) ?></td>
                                                        <td><?= esc($result['num_wrong']) ?></td>
                                                        <td><?= esc($result['score']) ?></td>
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

                                            const filter = document.getElementById("periode_data").value; // Value in 'ym' format
                                            const table = document.getElementById("dataTable");
                                            const rows = table.getElementsByTagName("tr");

                                            for (let i = 1; i < rows.length; i++) { // Skip the header row
                                                const cells = rows[i].getElementsByTagName("td");
                                                if (cells.length > 0) {
                                                    const testDate = cells[4]?.textContent || cells[4]?.innerText; // Get 'Test Date' column value
                                                    const testDateYM = testDate ? testDate.substring(0, 7).replace("-", "") : ""; // Extract 'ym' format

                                                    // Show row if it matches the filter; otherwise hide it
                                                    rows[i].style.display = testDateYM === filter ? "" : "none";
                                                }
                                            }
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
        
        <?php echo $this->include('partials/include_footer'); ?>
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
</script>

<?php $this->endSection() ?>