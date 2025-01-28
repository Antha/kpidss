<?php $this->extend('template_header_menu_page') ?>

<?php $this->section('content') ?>

<body>
    <div id="loadingSpinner">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden" style="color: #003057;">Loading...</span>
        </div>
    </div>
    <div class="quiz-page">
        
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
                            <div class="content-wrapper" style="min-height: 480px;">
                                <div class="row w-100">
                                    <div class="col-md-6 offset-md-3 text-center" style="font-size: 14px;">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <P>
                                                    <span id="timer"></span>
                                                </P>
                                                <p class="question mb-4"><strong>Question <?= $question_no ?>:</strong> <?= $question['question'] ?></p>
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

        <?php echo $this->include('partials/include_footer'); ?>
    </div>
</body>

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
</script>

<script>
    //spinner
    document.querySelector('form').addEventListener('submit', function () {
        // Show the spinner
        document.getElementById('loadingSpinner').style.display = 'flex';
    });

    let remainingSeconds = 0; // Variabel untuk menyimpan waktu tersisa
    let timerInterval = null;

    // Fungsi untuk memulai timer
    function startTimer(durationMinutes) {
        remainingSeconds = durationMinutes * 60;

        // Jalankan timer
        updateTimer();
    }

    // Fungsi untuk memperbarui timer
    function updateTimer() {
        timerInterval = setInterval(() => {
            if (remainingSeconds > 0) {
                remainingSeconds--; // Kurangi waktu tersisa
                const minutes = Math.floor(remainingSeconds / 60);
                const seconds = remainingSeconds % 60;

                // Update tampilan
                document.getElementById('timer').innerText = `${minutes}m ${seconds}s`;
            } else {
                clearInterval(timerInterval); // Hentikan timer jika selesai
                document.getElementById('timer').innerText = "Time's up!";
                window.location.href = '/quiz/result';
            }
        }, 1000);
    }


    // Simpan waktu tersisa ke database saat browser ditutup
    window.addEventListener('beforeunload', () => {
        fetch('/quiz/timer/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                remaining_seconds: remainingSeconds,
            }),
        });
    });

    // Cek apakah ada waktu tersisa di database saat halaman dimuat
    fetch(`/quiz/timer/get`)
        .then((response) => response.json())
        .then((data) => {
            if (data.status === 'success') {
                remainingSeconds = data.remaining_seconds;
                updateTimer(); // Lanjutkan timer
            } else {
                document.getElementById('timer').innerText = "30m 0s";
            }
        });

    startTimer(30);

</script>

<?php $this->endSection() ?>