<?php $this->extend('template_header_menu_page') ?>

<?php $this->section('content') ?>

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
                                <div class="date-update-wrapper">
                                    <a href="<?php echo base_url()."dashboard"?>" class="back-btn">
                                        <i class="fa-regular fa-circle-left float-start" style="font-size: 25px;padding-top: 2px;margin-right: 10px;"></i>
                                    </a>
                                    <h4 class="dark-blue-text float-end">LOYALTY</h4>
                                    <div style="clear: both;"></div>
                                </div>
                               
                                <div class="point-content">
                                    <div class="point-info container">
                                        <div class="row mt-2 justify-content-center">
                                            <div class="col-12 col-sm-12 mt-2">
                                                <div class="container-fluid rounded point-info-user p-3">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="d-inline-block">
                                                                <i class="fa-solid fa-coins icon-point d-inline-block" style="margin-right: 5px;color:#ffbd3a;"></i>
                                                                <h6 class="dark-blue-text d-inline-block"><?php echo $display_user_point; ?> POINT</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 offset-md-3 col-6 text-end">
                                                            <div class="redeem-summary-wrapper">
                                                                <h6 class="d-inline-block dark-blue-text" style="padding-right: 10px;">HISTORY</h6>
                                                                <button id="btn-toggle-redeem-summary" style="background: none;border: 0px;"><i class="fa-solid fa-circle-plus fac-dark-blue" style="font-size: 18px;"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if($product_redeems) { ?>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="table-wrapper-scroll-y-redeem-summary table-scroll-y">
                                                        <div class="table-responsive rounded">
                                                            <table class="table table-bordered table-striped table-hover table-sm">
                                                                <thead>
                                                                    <tr class="text-center bg-tb-blue" style="color: #fff;">
                                                                        <th scope="col">ITEM</th>
                                                                        <th scope="col">REDEEM DATE</th>
                                                                        <th scope="col" class="text-center">SUDAH DITERIMA ?</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($product_redeems as $redeem): ?>
                                                                        <tr>
                                                                            <td class="align-middle" style="padding-left: 10px;"><b><?= esc($redeem->product_name) ?></b></td>
                                                                            <td class="align-middle text-center" style="padding-left: 10px;"><b><?= esc($redeem->date_redeem) ?></b></td> <!-- Adjust the field names as necessary -->
                                                                            <td class="text-center">
                                                                                <div class="d-flex justify-content-center redeem-summary-wrap-btn mt-2 mb-2">
                                                                                    <?php if($redeem->status == 'NA'){ ?>
                                                                                        <button class="btn btn-success me-2" id="reedem_yes" data-id="<?= $redeem->id_redeem ?>">Yes</button>
                                                                                    <?php }else{ ?>
                                                                                        <img class="img-fluid" style="width: 30px;" src="<?php echo base_url("img/icon-success.png")?>">
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="product-redeem container mt-4">
                                        <!-- Filter Section -->
                                        <div class="filter-section mb-4 justify-content-end">
                                            <label for="pointFilter" class="form-label" style="margin-top: 5px;color:#505f77">Filter By Points:</label>
                                            <select id="pointFilter" class="form-select w-25" style="color: #505f77;">
                                                <option value="all">All</option>
                                                <option value="low">Below 1,000 Points</option>
                                                <option value="medium">1,000 - 5,000 Points</option>
                                                <option value="high">Above 5,000 Points</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <?php foreach($display_all_product as $rows){ ?>
                                                <div class="col-md-3 col-sm-6 mb-4 product-card" data-points="<?php echo $rows['product_point']; ?>">
                                                    <div class="card">
                                                        <img class="card-img-top img-fluid redeem-product-img p-2" src="<?php echo base_url('/uploads/loyalty/').$rows["product_image"]?>" alt="prize-redeem">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo ucwords($rows['product_name']); ?></h5>
                                                            <div class="product-point-group float-start">
                                                                <i class="fa-solid fa-coins icon-point"></i>
                                                                <p class="card-text product-point"><?php echo number_format($rows['product_point']); ?> poin</p>
                                                            </div>
                                                            <div class="product-stock-group float-end">
                                                                <i class="fa-solid fa-boxes-stacked icon-stock"></i>
                                                                <p class="card-text float-end product-stock">Stocks <?php echo $rows['product_stock']; ?></p>
                                                            </div>
                                                            <div style="clear: both;"></div>
                                                            <input data-image = "<?php echo base_url('/uploads/loyalty/').$rows["product_image"]?>" type="button" id="btn_submit_redeem_<?php echo $rows['id'];?>" name="btn_submit_redeem" value="REDEEM" class="mt-3 btn submit_btn redeem-btn float-end border_rad1"></input>
                                                        </div>
                                                    </div>
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
        <div class="modal fade" id="failModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background-color: transparent">
                    <div class="modal-body" style="background-color: #003057;border-radius: 8px;">
                        <div class="modal-title" style="text-align: center;padding: 30px 10px 0px 10px;">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-4">
                                        <img style="width: 60px;" class="img-fluid" src="<?php echo base_url('/img/icon-fail.png')?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h3 style="font-size: 20px;margin-top:15px;"><span id="fail-info"></span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button id="btn-finish-modal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 p-3">
                                <img style="width: 60px;" class="img-fluid" id="img-preview-redeem" src ="<?php echo base_url('/img/prize1.jpg')?>">
                            </div>
                            <div class="col-6 p-3 modal-body-info" style="
                                        border-top-right-radius: 8px;
                                        border-bottom-right-radius: 8px;">
                                <h5 class="modal-title mb-5" id="exampleModalLongTitle">Redeem Confirmation</h5>
                                <p class="modal-info-process">Anda akan melakukan proses redeem 1 buah <span id="modal-info-product-name" style="font-weight: bold;"></span> senilai <span id="modal-info-product-point" style="font-weight: bold;"></span> point. Lanjutkan proses?</p>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary btn-cancel-redeem" data-bs-dismiss="modal">CANCEL</button>
                                    <button type="button" class="btn btn-primary btn-conf-redeem" id="btn-redeem-conf"  data-bs-dismiss="modal">REDEEM</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="finishModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background-color: transparent">
                    <div class="modal-body" style="background-color: #003057;border-radius: 8px;">
                        <div class="modal-title" style="text-align: center;padding: 30px 10px 0px 10px;">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-4">
                                        <img class="img-fluid" src="<?php echo base_url('/img/icon-party.png')?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h3 style="font-size: 20px;margin-top:15px;">Redeem Berhasil</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btn-finish-modal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="background-color: transparent">
                    <div class="modal-body" style="background-color: #003057;border-radius: 8px;">
                        <div class="modal-title" style="text-align: center;padding: 30px 10px 0px 10px;">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-4">
                                        <img class="img-fluid" src="<?php echo base_url('/img/icon-success.png')?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h3 style="font-size: 20px;margin-top:15px;"><span id="success-info"></span></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btn-finish-modal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    
    $(".redeem-btn").on("click",function(){
        let productId = $(this).attr("id").split("btn_submit_redeem_");


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
            if(data.info == 'not enough point'){
                $("#fail-info").text("Maaf, point Anda tidak cukup");
                $("#failModal").modal('show');
            }else if(data.info == 'empty stock'){
                $("#fail-info").text("Maaf, stock habis");
                $("#failModal").modal('show');
            }else{
                $("#modal-info-product-name").text(data.parse_product_name);
                $("#modal-info-product-point").text(data.parse_product_point);
                $("#btn-redeem-conf").val(productId[1]);
                $("#confirmationModal").modal('show');
            }
          }
        });
    });

    $("#btn-redeem-conf").on("click", function(){
        let productId = $(this).val();
        let productPoint = $("#modal-info-product-point").text();

        $.ajax({
          type:"post",
          url :"<?php echo base_url(); ?>/loyalty/redeem_process",
          data: {
            product_id : productId,
            product_point : productPoint
          },
          cache: false,
          success: function (data) 
          {
            if(data == "success"){
               $("#finishModal").modal("show");
            }else{
                console.error();
            }
          }
        });
    });

    $("#reedem_yes").on("click", function(){
        let redeemID = $(this).data("id");
      
        $.ajax({
          type:"post",
          url :"<?php echo base_url(); ?>/loyalty/update_redeem_status",
          data: {
            redeemID
          },
          cache: false,
          success: function (data) 
          {
            window.location.reload();
          }
        });
    });

    $("#finishModal").on("hidden.bs.modal",function(){
        window.location.reload();
    })

    $("#failModal").on("hidden.bs.modal",function(){
        window.location.reload();
    })

    $("#btn-toggle-redeem-summary").on("click",function(){
        $(".table-wrapper-scroll-y-redeem-summary").slideToggle();
    });

    $("#pointFilter").on("change", function () {
        var selectedValue = $(this).val();
        $(".product-card").show(); // Show all products initially

        $(".product-card").each(function () {
            var points = parseInt($(this).data("points"));
            if (
                (selectedValue === "low" && points >= 1000) ||
                (selectedValue === "medium" && (points < 1000 || points > 5000)) ||
                (selectedValue === "high" && points <= 5000)
            ) {
                $(this).hide(); // Hide products that don't match the filter
            }
        });
    });
</script>

<?php $this->endSection() ?>