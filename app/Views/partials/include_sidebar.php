<div class="sidebarzz w3-bar-block w3-card" style="display:none" id="mySidebar">
    <div class="close-nav-btn-wrapper">
        <button class="btn close-nav-btn" onclick="w3_close()">&times;</button>
    </div>
    <nav class="nav flex-column">
        <a class="nav-link active" aria-current="page" href="<?php echo base_url('/pnp_test') ?>">
            <div class="row">
                <div class="col-sm-2 col-3">
                    <img class="img-fluid menu-icon-front" src="<?= base_url('/img/icon-quiz-white.png') ?>">
                    <img class="img-fluid menu-icon-back" src="<?= base_url('/img/icon-quiz-light-blue.png') ?>">
                </div>
                <div class="col-sm-10 col-9">
                    <span class="sidebar-title-menu">PNP TEST</span>
                </div>
            </div>
        </a>
        <a class="nav-link" href="<?php echo base_url('/kpi') ?>">
            <div class="row">
                <div class="col-sm-2 col-3">
                    <img class="img-fluid menu-icon-front" src="<?= base_url('/img/icon-kpi-white.png') ?>">
                    <img class="img-fluid menu-icon-back" src="<?= base_url('/img/icon-kpi-light-blue.png') ?>">
                </div>
                <div class="col-sm-10 col-9">
                    <span class="sidebar-title-menu">KPI</span>
                </div>
            </div>
        </a>
        <a class="nav-link" href="<?php echo base_url('/loyalty') ?>">
            <div class="row">
                <div class="col-sm-2 col-3">
                    <img class="img-fluid menu-icon-front" src="<?= base_url('/img/icon-loyalty-white.png') ?>">
                    <img class="img-fluid menu-icon-back" src="<?= base_url('/img/icon-loyalty-light-blue.png') ?>">
                </div>
                <div class="col-sm-10 col-9">
                    <span class="sidebar-title-menu">LOYALTY</span>
                </div>
            </div>
        </a>
        <a class="nav-link" href="<?php echo base_url('/product_knowledge') ?>">
            <div class="row">
                <div class="col-sm-2 col-3">
                    <img class="img-fluid menu-icon-front" src="<?= base_url('/img/icon-info-product-white.png') ?>">
                    <img class="img-fluid menu-icon-back" src="<?= base_url('/img/icon-info-product-light-blue.png') ?>">
                </div>
                <div class="col-sm-10 col-9">
                    <span class="sidebar-title-menu">PRODUCT KNOWLEDGE</span>
                </div>
            </div>
        </a>
        <?php if(session()->get('user_level') == 'admin'){ ?>
            <a class="nav-link" href="<?php echo base_url('/loyalty_input') ?>">
                <div class="row">
                    <div class="col-sm-2 col-3">
                        <img class="img-fluid menu-icon-front" src="<?= base_url('/img/icon-setting-white.png') ?>">
                        <img class="img-fluid menu-icon-back" src="<?= base_url('/img/icon-setting-light-blue.png') ?>">
                    </div>
                    <div class="col-sm-10 col-9">
                        <span class="sidebar-title-menu">SET PRODUCT REDEEM</span>
                    </div>
                </div>
            </a>
            <a class="nav-link" href="<?php echo base_url('/product_knowledge_input') ?>">
                <div class="row">
                    <div class="col-sm-2 col-3">
                        <img class="img-fluid menu-icon-front" src="<?= base_url('/img/icon-setting-white.png') ?>">
                        <img class="img-fluid menu-icon-back" src="<?= base_url('/img/icon-setting-light-blue.png') ?>">
                    </div>
                    <div class="col-sm-10 col-9">
                        <span class="sidebar-title-menu">SET PRODUCT KNOWLEDGE</span>
                    </div>
                </div>
            </a>
        <?php } ?>
    </nav>  
</div>