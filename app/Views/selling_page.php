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
                                <div class="display-4 text-center">
                                   Selling Page
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid mt-5">
                            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4 justify-content-center">
                                <?php if (!empty($pics)): ?>
                                    <?php foreach ($pics as $row): ?>
                                        <div class="col">
                                            <div class="card shadow-sm border-0">
                                                <img src="<?= base_url('uploads/photos/' . esc($row["pic"])) ?>" 
                                                    class="rounded" alt="Foto">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="col-12 text-center">
                                        <div class="alert alert-warning" role="alert">
                                            Belum ada foto yang tersedia.
                                        </div>
                                    </div>
                                <?php endif; ?>
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