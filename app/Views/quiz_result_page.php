<?php $this->extend('template_header_menu_page') ?>

<?php $this->section('content') ?>

<style>
    .result {
        display: flex;  /* Menggunakan Flexbox untuk menampilkan elemen secara horizontal */
        justify-content: space-between;  /* Memberikan jarak antar elemen */
        background-color: #f0f8ff;
        padding: 10px;
        border-radius: 5px;
        width: 100%;  /* Memastikan div mengambil seluruh lebar kontainer */
        margin: 10px auto;
    }

    .result p {
        font-size: 16px;
        margin: 0 10px;  /* Memberikan jarak antar elemen di kiri dan kanan */
    }

    .result strong {
        color: #2e8b57;
    }
</style>

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
                                s<div class="row w-100">
                                    <div class="col-md-6 offset-md-3 text-center">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <h1 class="mb-4">Your Quiz Results</h1>
                                                <ul class="list-group mb-4">
                                                    <?php foreach ($answers as $key => $answer): ?>
                                                        <li class="list-group-item">
                                                            <strong>Question <?= $answer["question_id"] ?>:</strong> Your Answer - <?= htmlspecialchars($answer["answer"]) ?>
                                                            ( <?= isset($answer["is_right"]) && $answer["is_right"] == 1 ? 'Right' : 'Wrong' ?> )
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <?php 
                                                    $totalIsRight = 0;
                                                    $totalIsWrong = 0;
                                                    
                                                    foreach ($answers as $item) {
                                                        $totalIsRight += $item['is_right'];
                                                        $totalIsWrong += $item['is_wrong'];
                                                    }

                                                    // Menampilkan hasil
                                                    echo "<div class='result'>";
                                                    echo "<p><strong>Right Answer:</strong> " . $totalIsRight . "</p>";
                                                    echo "<p><strong>Wrong Answer:</strong> " . $totalIsWrong . "</p>";
                                                    echo "<p><strong>Score:</strong> " . ($totalIsRight * 10) . "</p>";
                                                    echo "</div>";
                                                ?>
                                                <a href="/dashboard" class="btn btn-primary">Back to Dashboard</a>
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