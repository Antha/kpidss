<?php $this->extend('template_header_menu_page') ?>

<?php $this->section('content') ?>

<body>
    <div class="dashboard-page page-height">
        
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
                                <div class="date-update-wrapper">
                                    <a href="<?php echo base_url()."dashboard"?>" class="back-btn">
                                        <i class="fa-regular fa-circle-left float-start" style="font-size: 25px;padding-top: 2px;margin-right: 10px;"></i>
                                    </a>
                                    <h4 class="dark-blue-text float-end">PRODUCT KNOWLEDGE</h4>
                                    <div style="clear: both;"></div>
                                </div>
                                <div class="point-content">

                                    <div class="container product-knowledge mt-4">
                                        <div class="row">
                                            <?php foreach($display_all_product as $rows){ ?>
                                                <div class="col-md-3 col-sm-6 mb-4">
                                                    <a class="card" href="#" style="width: 100%;">
                                                        <img class="card-img-top img-fluid redeem-product-img" src="<?php echo base_url('/uploads/product_knowledge/').$rows["product_image"]?>" alt="prize-redeem">
                                                        <div class="card-body">
                                                            <h5 class="card-title detail-title"><?php echo ucwords($rows['product_name']); ?></h5>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
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
        
        <!-- Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 p-3">
                                <img class="img-fluid" id="img-preview-redeem" src ="<?php echo base_url('/img/prize1.jpg')?>">
                            </div>
                            <div class="col-sm-6 p-3 modal-body-info" style="
                                        border-top-right-radius: 8px;
                                        border-bottom-right-radius: 8px;">
                                <h5 class="modal-title mb-5" id="modal-info-product-name"></h5>
                                <p class="modal-info-product-detail"></p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-close" data-bs-dismiss="modal">CLOSE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--modal-->
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
    
    $(".detail-btn").on("click",function(){
        let productId = $(this).attr("id").split("btn_view_detail_");


        // Menyeting src gambar target dengan src gambar sumber
        $('#img-preview-redeem').attr('src', $(this).data("image"));


        $.ajax({
          type:"post",
          url :"<?php echo base_url(); ?>/loyalty/cek_redeem_point",
          data: {
            product_id : productId[1]
          },
          dataType: "json",
          cache: false,
          success: function (data) 
          {
            $("#modal-info-product-name").text(data.parse_product_name);
            $("#modal-info-product-detail").text(data.parse_product_detail);
            $("#detailModal").modal('show');
          }
        });
    });
</script>

<?php $this->endSection() ?>