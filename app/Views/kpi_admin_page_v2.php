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
                                    <h4 class="dark-blue-text">KPI</h4>
                                    <div style="clear: both;"></div>
                                    <span>last update : <?php echo $update_date; ?></span>
                                </div>
                               
                                <div class="table-group-wrapper">
                                    <div class="container-fluid p-0 mt-3">
                                        <div class="row mb-2">
                                            <div class="col-12" style="margin-top: 15px;">
                                                <h6>SUMMARY</h6>
                                            </div>
                                            <div class="col-4 col-sm-10 col-lg-11">
                                                <span style="font-size: 12px;margin-top: 10px;display: inline-block;" class="sub-title-table sub-title-table">
                                                    AREA 3            
                                                </span>
                                            </div>

                                            <div class="col-3 col-sm-2 col-lg-1" style="padding-left: 0px;">
                                                <button id="btn_dl_data_admin" class="submit_btn border_rad1" style="width: 100%;">DOWNLOAD</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="table-wrapper-scroll-y table-scroll-y">
                                                    <div class="table-top-scroll">
                                                        <div class="table-scroll-bar"></div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table id="dataTable"  class="table table-bordered table-hover table-custom">
                                                            <thead>
                                                                <tr class="bg-tb-main">
                                                                    <th rowspan="2" colspan="2">CLUSTER</th>
                                                                    <th rowspan="2">TARGET SO</th>
                                                                    <th colspan="3">JUMLAH DS</th>
                                                                    <th rowspan="2">EVENT</th>
                                                                    <th rowspan="2">SITE SSGJ</th>
                                                                    <th colspan="3">TRX</th>
                                                                    <th colspan="4">REVENUE</th>
                                                                </tr>
                                                                <tr class="bg-tb-main">
                                                                    <th>DS</th>
                                                                    <th>DS ACTIVE</th>
                                                                    <th>% ACTIVE</th>
                                                                    <th>VAS</th>
                                                                    <th>RECHARGE</th>
                                                                    <th>SO</th>
                                                                    <th>REVENUE ALL</th>
                                                                    <th>DATA</th>
                                                                    <th>DIGITAL</th>
                                                                    <th>DIGISTAR</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="dataTable_body_filter">
                                                                <?php foreach($result_kpi_data as $rows){ ?>
                                                                    <tr>
                                                                        <td><?php echo $rows['BRANCH'];?></td>
                                                                        <td><?php echo $rows['CLUSTER'];?></td>
                                                                        <td class="text-center"><?php echo nf0($rows['TARGET_SO']);?></td>
                                                                        <td class="text-center"><?php echo $rows['DS'];?></td>
                                                                        <td class="text-center"><?php echo $rows['DS_ACTIVE'];?></td>
                                                                        <td class="text-center"><?php echo $rows['PERCENT_ACTIVE'];?></td>
                                                                        <td class="text-center"><?php echo $rows['EVENT'];?></td>
                                                                        <td class="text-center"><?php echo $rows['SITE_SSGJ'];?></td>
                                                                        <td class="text-center"><?php echo $rows['TRX_VAS'];?></td>
                                                                        <td class="text-center"><?php echo $rows['TRX_RECHARGE'];?></td>
                                                                        <td class="text-center"><?php echo $rows['TRX_SO'];?></td>
                                                                        <td class="text-end"><?php echo nf0($rows['REV_ALL']);?></td>
                                                                        <td class="text-end"><?php echo nf0($rows['REV_DATA']);?></td>
                                                                        <td class="text-end"><?php echo nf0($rows['REV_DIGITAL']);?></td>
                                                                        <td class="text-end"><?php echo nf0($rows['REV_DIGISTAR']);?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container-fluid p-0">
                                        <div class="row mt-3">
                                            <h5 class="mb-3">REPLACE DATA</h5>
                                            <div class="container-fluid mt-2 mt-sm-4">
                                                <div class="row justify-content-center">
                                                    <div class="col-10 col-md-10 col-lg-8 col-xl-8 border rounded px-3 py-4 filter_group_top bg-body-secondary">
                                                        <!--ERROR MESSAGE -->
                                                        <?php if(session()->getFlashdata('error')): ?>
                                                            <div class="alert alert-danger w-100 mb-3">
                                                                <?= session()->getFlashdata('error') ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if(session()->getFlashdata('success')): ?>
                                                            <div class="alert alert-success w-100 mb-3">
                                                                <?= session()->getFlashdata('success') ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <!-- FORM UPLOAD & PREVIEW -->
                                                        <form method="post"
                                                            action="<?= base_url('kpi/preview') ?>"
                                                            enctype="multipart/form-data"
                                                            onsubmit="return validateCSV()"
                                                            id="formUpload">

                                                            <?= csrf_field() ?>

                                                            <select name="table_name" id="table_name_select" required class="form-select mb-2">
                                                                <?php foreach($list_kpi_table as $rows){ ?>
                                                                    <option value="<?php echo $rows['TABLE_NAME'];?>"><?php echo $rows['TABLE_NAME'];?></option>
                                                                <?php } ?>
                                                            </select>

                                                            <input type="file"
                                                                name="csv_file"
                                                                id="csv_file"
                                                                class="form-control mb-2"
                                                                required>

                                                            <div class="col-12 text-end d-flex justify-content-end gap-2">

                                                                <button type="submit" class="btn submit_btn fw-bold" style="font-size: 12px;">
                                                                    Upload & Preview
                                                                </button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-8 col-md-8 col-lg-8 col-xl-8 border rounded px-3 py-4 mt-4 mb-4 bg-body-secondary">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-9 pt-2">
                                                                <h6 class="fw-light fst-italic text-info-emphasis">Download Contoh Kolom dan Data yang Sesuai Dengan Database</h6>
                                                            </div>
                                                            <div class="offset-6 col-6 offset-sm-0 col-sm-3 text-end">
                                                                <!-- FORM DOWNLOAD SAMPLE (TERPISAH) -->
                                                                <form method="post"
                                                                    action="<?= base_url('kpi/download/sample') ?>"
                                                                    id="formDownloadSample">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" name="table_name" id="table_name_download">
                                                                    <button type="submit" class="btn submit_btn fw-bold" style="font-size: 12px;">
                                                                        Download Sample
                                                                    </button>
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
                </div>
               
            </div>

        </div>
        
        <?php echo $this->include('partials/include_footer'); ?>
    </div>
</body>

<link rel="stylesheet" href="<?php echo base_url('/css/datepicker.css') ?>">
<script type="text/javascript" src="<?php echo base_url('/script/bootstrap-datepicker.js') ?>"></script>
<script>
    function validateCSV() {
        const file = document.getElementById('csv_file').value;
        if (!file.endsWith('.csv')) {
            alert('Only CSV files allowed');
            return false;
        }
        return true;
    }

    const tableSelect = document.querySelector('select[name="table_name"]');
    const tableHidden = document.getElementById('table_name_download');

    // set nilai awal
    tableHidden.value = tableSelect.value;

    // update saat select berubah
    tableSelect.addEventListener('change', function () {
    tableHidden.value = this.value;
});
</script>
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

    $('#periode_data').datepicker({
        format: "yyyymm",
        startView: 1,
        minViewMode:1,
        autoclose: true,
        todayHighlight: true
    });

    function filterTable() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toLowerCase();
        const table = document.getElementById("dataTable");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let match = false;
            
            for (let j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    const textValue = cells[j].textContent || cells[j].innerText;
                    if (textValue.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }
            
            rows[i].style.display = match ? "" : "none";
        }
    }

    $('#kpi_filter_regional_admin').on('change', function(){
        $('#kpi_filter_branch_admin').html('');
        $('#kpi_filter_cluster_admin').html('');

        $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
        if($('#kpi_filter_regional_admin').val()=="BALI NUSRA"){
            $('#kpi_filter_branch_admin').append('<option value="" selected disabled>Branch</option>');
            $('#kpi_filter_branch_admin').append('<option value="DENPASAR">DENPASAR</option>');
            $('#kpi_filter_branch_admin').append('<option value="FLORES">FLORES</option>');
            $('#kpi_filter_branch_admin').append('<option value="KUPANG">KUPANG</option>');
            $('#kpi_filter_branch_admin').append('<option value="MATARAM">MATARAM</option>');
        }else if($('#kpi_filter_regional_admin').val()=="JATENG-DIY"){
            $('#kpi_filter_branch_admin').append('<option value="" selected disabled>Branch</option>');
            $('#kpi_filter_branch_admin').append('<option value="MAGELANG">MAGELANG</option>');
            $('#kpi_filter_branch_admin').append('<option value="PEKALONGAN">PEKALONGAN</option>');
            $('#kpi_filter_branch_admin').append('<option value="PURWOKERTO">PURWOKERTO</option>');
            $('#kpi_filter_branch_admin').append('<option value="SEMARANG">SEMARANG</option>');
            $('#kpi_filter_branch_admin').append('<option value="SURAKARTA">SURAKARTA</option>');
            $('#kpi_filter_branch_admin').append('<option value="YOGYAKARTA">YOGYAKARTA</option>');
        }else if($('#kpi_filter_regional_admin').val()=="JATIM"){
            $('#kpi_filter_branch_admin').append('<option value="" selected disabled>Branch</option>');
            $('#kpi_filter_branch_admin').append('<option value="JEMBER">JEMBER</option>');
            $('#kpi_filter_branch_admin').append('<option value="LAMONGAN">LAMONGAN</option>');
            $('#kpi_filter_branch_admin').append('<option value="MADIUN">MADIUN</option>');
            $('#kpi_filter_branch_admin').append('<option value="MALANG">MALANG</option>');
            $('#kpi_filter_branch_admin').append('<option value="SIDOARJO">SIDOARJO</option>');
            $('#kpi_filter_branch_admin').append('<option value="SURABAYA">SURABAYA</option>');
        }
        
    });

    $('#kpi_filter_branch_admin').on('change', function(){
        $('#kpi_filter_cluster_admin').html('');

        if($('#kpi_filter_branch_admin').val()=="DENPASAR"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="BALI BARAT">BALI BARAT</option>');
            $('#kpi_filter_cluster_admin').append('<option value="BALI TENGAH">BALI TENGAH</option>');
            $('#kpi_filter_cluster_admin').append('<option value="BALI TIMUR">BALI TIMUR</option>');
        }else if($('#kpi_filter_branch_admin').val()=="FLORES"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="ENDE SIKKA">ENDE SIKKA</option>');
            $('#kpi_filter_cluster_admin').append('<option value="FLORES TIMUR">FLORES TIMUR</option>');
            $('#kpi_filter_cluster_admin').append('<option value="MANGGARAI">MANGGARAI</option>');
        }else if($('#kpi_filter_branch_admin').val()=="KUPANG"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="KUPANG ROTE">KUPANG ROTE</option>');
            $('#kpi_filter_cluster_admin').append('<option value="MALAKA TIMTIM BELU">MALAKA TIMTIM BELU</option>');
            $('#kpi_filter_cluster_admin').append('<option value="SUMBA">SUMBA</option>');
        }else if($('#kpi_filter_branch_admin').val()=="MATARAM"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="LOMBOK">LOMBOK</option>');
            $('#kpi_filter_cluster_admin').append('<option value="SUMBAWA BARAT">SUMBAWA BARAT</option>');
            $('#kpi_filter_cluster_admin').append('<option value="SUMBAWA TIMUR">SUMBAWA TIMUR</option>');
        }else if($('#kpi_filter_branch_admin').val()=="MAGELANG"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="MAGELANG KOTA">MAGELANG KOTA</option>');
            $('#kpi_filter_cluster_admin').append('<option value="NEW KEBUMEN">NEW KEBUMEN</option>');
        }else if($('#kpi_filter_branch_admin').val()=="PEKALONGAN"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="NEW BATANG">NEW BATANG</option>');
            $('#kpi_filter_cluster_admin').append('<option value="TEGAL BREBES">TEGAL BREBES</option>');
        }else if($('#kpi_filter_branch_admin').val()=="PURWOKERTO"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="BANJARNEGARA">BANJARNEGARA</option>');
            $('#kpi_filter_cluster_admin').append('<option value="CILCAP MAS">CILCAP MAS</option>');
        }else if($('#kpi_filter_branch_admin').val()=="SEMARANG"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="DEMAK">DEMAK</option>');
            $('#kpi_filter_cluster_admin').append('<option value="JEPARA KUDUS">JEPARA KUDUS</option>');
            $('#kpi_filter_cluster_admin').append('<option value="PATI">PATI</option>');
            $('#kpi_filter_cluster_admin').append('<option value="SEMARANG">SEMARANG</option>');
        }else if($('#kpi_filter_branch_admin').val()=="SURAKARTA"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="BOYOLALI">BOYOLALI</option>');
            $('#kpi_filter_cluster_admin').append('<option value="SRAGEN">SRAGEN</option>');
            $('#kpi_filter_cluster_admin').append('<option value="SURAKARTA">SURAKARTA</option>');
        }else if($('#kpi_filter_branch_admin').val()=="YOGYAKARTA"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="DAERAH ISTIMEWA YOGYAKARTA">DAERAH ISTIMEWA YOGYAKARTA</option>');
        }else if($('#kpi_filter_branch_admin').val()=="JEMBER"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="BANYUWANGI">BANYUWANGI</option>');
            $('#kpi_filter_cluster_admin').append('<option value="JEMBER">JEMBER</option>');
            $('#kpi_filter_cluster_admin').append('<option value="KOTA PROBOLINGGO">KOTA PROBOLINGGO</option>');
            $('#kpi_filter_cluster_admin').append('<option value="SITUBONDO">SITUBONDO</option>');
        }else if($('#kpi_filter_branch_admin').val()=="LAMONGAN"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="LAMONGAN GRESIK">LAMONGAN GRESIK</option>');
            $('#kpi_filter_cluster_admin').append('<option value="TUBAN BOJONEGORO">TUBAN BOJONEGORO</option>');
        }else if($('#kpi_filter_branch_admin').val()=="MADIUN"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="KEDIRI">KEDIRI</option>');
            $('#kpi_filter_cluster_admin').append('<option value="MADIUN">MADIUN</option>');
            $('#kpi_filter_cluster_admin').append('<option value="PONOROGO">PONOROGO</option>');
        }else if($('#kpi_filter_branch_admin').val()=="MALANG"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="MALANG">MALANG</option>');
            $('#kpi_filter_cluster_admin').append('<option value="TULUNGAGUNG">TULUNGAGUNG</option>');
        }else if($('#kpi_filter_branch_admin').val()=="SIDOARJO"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="JOMBANG MOJOKERTO">JOMBANG MOJOKERTO</option>');
            $('#kpi_filter_cluster_admin').append('<option value="SIDOARJO PASURUAN">SIDOARJO PASURUAN</option>');
        }else if($('#kpi_filter_branch_admin').val()=="SURABAYA"){
            $('#kpi_filter_cluster_admin').append('<option value="" selected disabled>Cluster</option>');
            $('#kpi_filter_cluster_admin').append('<option value="KOTA SURABAYA">KOTA SURABAYA</option>');
            $('#kpi_filter_cluster_admin').append('<option value="MADURA">MADURA</option>');
        }
        
    });

    function filterTable() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toLowerCase();
        const table = document.getElementById("dataTable_body_filter");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            let match = false;
            
            for (let j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    const textValue = cells[j].textContent || cells[j].innerText;
                    if (textValue.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }
            
            rows[i].style.display = match ? "" : "none";
        }
    }

    $('#btn_dl_data_admin').click(function () {
        //alert("Hai");
        // Function to export table to CSV
        // function exportTableToCSV(filename) {
        //     var csv = [];
        //     var rows = $('#dataTable tbody').find('tr');

        //     rows.each(function () {
        //         var row = [];
        //         $(this).find('th, td').each(function () {
        //             // Wrap content in double quotes to handle commas within cells
        //             row.push('"' + $(this).text().trim() + '"');
        //         });
        //         csv.push(row.join(','));
        //     });

        //     // Create a blob with the CSV content
        //     var csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });

        //     // Create a download link
        //     var downloadLink = document.createElement('a');
        //     downloadLink.download = filename;
        //     downloadLink.href = window.URL.createObjectURL(csvFile);
        //     downloadLink.style.display = 'none';

        //     // Append the link and trigger the download
        //     document.body.appendChild(downloadLink);
        //     downloadLink.click();
        //     document.body.removeChild(downloadLink);
        // }

        function exportTableToCSV(filename) {
            var csv = [];
            var rows = $('#dataTable tbody').find('tr');

            rows.each(function () {
                var row = [];
                $(this).find('th, td').each(function () {
                    // Bungkus isi sel dengan tanda kutip ganda untuk menangani koma dalam sel
                    row.push('"' + $(this).text().trim() + '"');
                });
                csv.push(row.join(','));
            });

            var csvContent = csv.join("\n");
            var blob = new Blob([csvContent], { type: "text/csv" });

            // Deteksi apakah dijalankan di Android atau browser
            if (window.Android && typeof window.Android.downloadCSV === 'function') {
                // Android: Kirim data melalui JavaScriptInterface
                var reader = new FileReader();
                reader.onload = function () {
                    window.Android.downloadCSV(reader.result, filename);
                };
                reader.readAsText(blob);
            } else {
                // Browser: Gunakan mekanisme unduh standar
                var downloadLink = document.createElement('a');
                downloadLink.href = URL.createObjectURL(blob);
                downloadLink.download = filename;
                downloadLink.style.display = 'none';

                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }
        }

        // function exportTableToCSV(filename) {
        //     var csv = [];
        //     var rows = document.querySelectorAll("#dataTable tbody tr");

        //     rows.forEach(function (row) {
        //         var rowData = [];
        //         row.querySelectorAll("th, td").forEach(function (cell) {
        //             rowData.push('"' + cell.textContent.trim() + '"');
        //         });
        //         csv.push(rowData.join(","));
        //     });

        //     var csvContent = csv.join("\n");

        //     // Buat Blob
        //     var blob = new Blob([csvContent], { type: "text/csv" });

        //     // Gunakan Fetch API untuk mengunduh
        //     fetch(URL.createObjectURL(blob))
        //         .then((res) => res.blob())
        //         .then((blob) => {
        //             // Simpan Blob ke Android menggunakan JavaScriptInterface
        //             window.Android.downloadCSV(blob, filename);
        //         });
        // }


        // Call the function with a file name
        const dateformat = new Date().toISOString().replace(/[-:.TZ]/g, '').slice(0, 14); // Format YYYYMMDDHHMMSS
        const exported_fname = `table_export_${dateformat}.csv`;
        exportTableToCSV(exported_fname);

    });

    $('.table-scroll-bar').width($('#dataTable').outerWidth());

    // Synchronize scrolling
    $('.table-top-scroll').on('scroll', function () {
        $('.table-responsive').scrollLeft($(this).scrollLeft());
    });

    $('.table-responsive').on('scroll', function () {
        $('.table-top-scroll').scrollLeft($(this).scrollLeft());
    });
</script>

<?php $this->endSection() ?>