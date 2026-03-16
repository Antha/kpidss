<div class="greeting float-end rounded ps-3 fw-bold text-white">
    <!--<h6 class="d-inline-block">
        Welcome <?= session('username') ?> (<?= session('role') ?>)
    </h6>-->
    <h6 class="d-inline-block">
        Logout
    </h6>
   
    <form class="float-end btn-logout-form" action="/logout">
        <button class="btn btn_logout pt-2 ps-2" type="submit" name="LOGOUT" title="LOGOUT">
            <div class="inner_content">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
        </button>
    </form>
</div>