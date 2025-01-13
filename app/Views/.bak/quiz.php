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
                                <div class="user-name-ses-display text-end">
                                    <h6 class="d-inline-block"> <?= session('username') ?></h6>
                                    <form class="float-end btn-logout-form" action="">
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
</body>

<?php $this->endSection() ?>
