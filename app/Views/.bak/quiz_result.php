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
                                    <h1 class="mb-4">Your Quiz Results</h1>
                                    <ul class="list-group mb-4">
                                        <?php foreach ($answers as $key => $answer): ?>
                                            <li class="list-group-item">
                                                <strong>Question <?= $answer["question_id"] ?>:</strong> Your Answer - <?= htmlspecialchars($answer["answer"]) ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <a href="/dashboard" class="btn btn-primary">Back to Dashboard</a>
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
