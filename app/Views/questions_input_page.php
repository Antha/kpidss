<?php $this->extend('template_header_menu_page') ?>

<?php $this->section('content') ?>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkAWnE66-S2rVK8XBXPp2LLGVePFEw0x0&libraries=places,geometry&callback=initMap" async defer></script>
  -->
<script src="script/mapsJavaScriptAPI.js"></script>

<script src="/script/sweetalert/sweetalert2@11.js"></script>
<style>
    /* Gaya CSS untuk ukuran peta */
    #map {
        height: 400px;
        width: 100%;
    }
</style>

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
                                <div class="row w-100">
                                    <div class="col-md-6 offset-md-3 text-center">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <div class="card shadow">
                                                    <div class="card-header text-center">
                                                        <h3>Import Questions</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <!-- Flash messages -->
                                                        <?php if (session()->getFlashdata('success')): ?>
                                                            <div class="alert alert-success" role="alert">
                                                                <?= session()->getFlashdata('success') ?>
                                                            </div>
                                                        <?php elseif (session()->getFlashdata('error')): ?>
                                                            <div class="alert alert-danger" role="alert">
                                                                <?= session()->getFlashdata('error') ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <!-- Upload Form -->
                                                        <form action="<?= base_url('/questions/import') ?>" method="post" enctype="multipart/form-data" class="mb-4">
                                                            <div class="mb-3">
                                                                <label for="csv_file" class="form-label">Upload CSV File</label>
                                                                <input type="file" name="csv_file" id="csv_file" class="form-control" accept=".csv" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary w-100">Import Data</button>
                                                        </form>

                                                        <!-- Download Sample CSV -->
                                                        <div class="text-center">
                                                            <a href="<?= base_url('/questions/sample-csv') ?>" class="btn btn-link">Download Sample CSV</a>
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
</script>

<?php $this->endSection() ?>