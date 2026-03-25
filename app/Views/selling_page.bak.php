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
                                <div class="display-5 text-center">
                                   SELLING PAGE
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="main-menu-wrapper row justify-content-center mt-5">
                                <div class="col-md-10">
                                    <div class="row g-3">
                                        <!-- Foto 1 -->
                                        <?php foreach ($pics as $row): ?>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="card">
                                                <img src="./uploads/photos/<?= esc($row["pic"])?>" class="card-img-top" alt="Foto 1">
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
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

<script>
    // Page load animation
    window.onload = function () {
       
    };
</script>

<?php $this->endSection() ?>