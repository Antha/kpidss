<div class="greeting float-end">
    <h6 class="d-inline-block"> Welcome, <?= session('username') ?></h6>
        <form class="float-end btn-logout-form" action="/logout">
            <button class="btn btn_logout" type="submit" name="LOGOUT" title="LOGOUT">
                <div class="inner_content">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
            </button>
        </form>
    </div>
</div>