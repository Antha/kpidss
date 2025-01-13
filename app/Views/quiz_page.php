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
                                <div class="greeting float-end">
                                    <h6 class="d-inline-block">Welcome,  <?= session('username') ?></h6>
                                    <form class="float-end btn-logout-form" action="/logout">
                                        <button class="btn btn_logout" type="submit" name="LOGOUT" title="LOGOUT">
                                            <div class="inner_content">
                                                <i class="fa-solid fa-right-from-bracket"></i>
                                            </div>
                                        </button>
                                    </form>
                                </div>
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
                                                <p class="question mb-4"><strong>Question <?= $questionNumber ?>:</strong> <?= $question['question'] ?></p>
                                                <form action="/quiz/<?= $questionNumber + 1 ?>" method="post">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="question_id" value="<?= $question['id'] ?>">
                                                    <ul class="list-group mb-4">
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answer" value="A" id="optionA" required>
                                                                <label class="form-check-label" for="optionA">
                                                                    <?= $question['option_a'] ?>
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answer" value="B" id="optionB" required>
                                                                <label class="form-check-label" for="optionB">
                                                                    <?= $question['option_b'] ?>
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answer" value="C" id="optionC" required>
                                                                <label class="form-check-label" for="optionC">
                                                                    <?= $question['option_c'] ?>
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answer" value="D" id="optionD" required>
                                                                <label class="form-check-label" for="optionD">
                                                                    <?= $question['option_d'] ?>
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <button type="submit" class="btn btn-primary">Next</button>
                                                </form>
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