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
                                <div class="date-update-wrapper" style="width: 100%;">
                                    <a href="<?php echo base_url()."dashboard"?>" class="back-btn">
                                        <i class="fa-regular fa-circle-left float-start" style="font-size: 25px;padding-top: 2px;margin-right: 10px;"></i>
                                    </a>
                                    <h4 class="dark-blue-text">PNP TEST LOMBOK SUMMARY</h4>
                                    <span class="mt-2 mb-2 d-inline-block">last update : <?php echo $lastUpdateData; ?></span>
                                </div>

                                <div class="row">
                                    <div class = "col-12">
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td style="border: 0px !important">Soal dengan persentase benar tertinggi adalah nomor <?php echo $hrNo;?>, dengan persentase <?php echo $hrPrcnt;?>%</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border: 0px !important">Soal dengan persentase benar terendah adalah nomor <?php echo $lrNo;?>, dengan persentase <?php echo $lrPrcnt;?>%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="table-wrapper-scroll-y table-scroll-y">
                                    <div class="table-top-scroll">
                                        <div class="table-scroll-bar"></div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-custom" id="dataTable">
                                            <thead>
                                                <tr class="bg-tb-blue">
                                                    <th scope="col">Rank</th>
                                                    <th scope="col">Agent ID</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col" style="min-width: 300px;">DSS Name</th>
                                                    <th scope="col">Right Answer</th>
                                                    <th scope="col">Wrong Answer</th>
                                                    <th scope="col">Score Detail</th>
                                                    <th scope="col">Score</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Branch</th>
                                                    <th scope="col" style="min-width: 200px;">Cluster</th>
                                                    <th scope="col" style="min-width: 200px;">City</th>
                                                    <th scope="col" style="min-width: 200px;">Test Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($resumeResults)): ?>
                                                    <?php foreach ($resumeResults as $index => $result): ?>
                                                        <tr>
                                                            <td class="text-center"><?= $index + 1 ?></td>
                                                            <td><?= esc($result['Agent ID']) ?></td>
                                                            <td><?= esc($result['role']) ?></td>
                                                            <td id="ds_name"><?= esc($result['DSS Name']) ?></td>
                                                            <td class="text-center"><?= esc($result['num_right']) ?></td>
                                                            <td class="text-center"><?= esc($result['num_wrong']) ?></td>
                                                            <td class="text-center"><btn type="button" id="btn_score_<?php echo $result['quiz_id'];?>" name="btn_score_detail" value="DETAIL" class="btn btn_score_detail submit_btn border_rad1" style="font-size: 11px;">Detail</btn></td>
                                                            <td class="text-center"><?= esc($result['score']) ?></td>
                                                            <td><?= esc($result['status']) ?></td>
                                                            <td><?= esc($result['branch']) ?></td>
                                                            <td><?= esc($result['cluster']) ?></td>
                                                            <td><?= esc($result['city']) ?></td>
                                                            <td class="text-center"><?= esc($result['datetime']) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="9" class="text-center">No data available</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                            <script>
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
                                            </script>
                                        </table>
                                    </div>
                                </div>

                            </div> 
                        </div>
                    </div>
                </div>
               
            </div>

        </div>
        
         <!-- Modal -->
        <div class="modal fade" id="scoreDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="border-radius: 8px;">
                        <div class="modal-title text-center" style="padding: 30px 10px 0px 10px;">
                            <h3 style="font-size: 20px;margin-top:15px;color:black;">SCORE DETAIL</h3>
                        </div>

                        <!-- Container untuk tabel -->
                        <div id="scoreDetailTableContainer" class="mt-3 p-2">
                            <div class="text-center text-muted">Loading...</div>
                        </div>

                        <div class="modal-footer justify-content-center">
                            <button id="btn-finish-modal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
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

    $(document).ready(function() {
        $('#periode_data').datepicker({
            format: "yyyymm",
            startView: 1,
            minViewMode:1,
            autoclose: true,
            todayHighlight: true
        });

        $('.table-scroll-bar').width($('#dataTable').outerWidth());

        // Synchronize scrolling
        $('.table-top-scroll').on('scroll', function () {
            $('.table-responsive').scrollLeft($(this).scrollLeft());
        });

        $('.table-responsive').on('scroll', function () {
            $('.table-top-scroll').scrollLeft($(this).scrollLeft());
        });

        const clusterOptions = {
            "DENPASAR": ["BALI BARAT", "BALI TENGAH", "BALI TIMUR"],
            "FLORES": ["ENDE SIKKA", "FLORES TIMUR", "MANGGARAI"],
            "KUPANG": ["KUPANG ROTE", "MALAKA TIMTIM BELU", "SUMBA"],
            "MATARAM": ["LOMBOK", "SUMBAWA BARAT", "SUMBAWA TIMUR"]
        };

        $('#filter_branch_admin').on('change', function() {
            let branch = $(this).val();
            let clusterDropdown = $('#filter_cluster_admin');
            let cityDropdown = $('#filter_city_admin');
            
            clusterDropdown.html('<option value="" selected disabled>Cluster</option>');
            if(branch == 'ALL'){
                cityDropdown.html('<option value="" selected disabled>City</option>');
            }
        
            if (clusterOptions[branch]) {
                clusterOptions[branch].forEach(cluster => {
                    clusterDropdown.append(`<option value="${cluster}">${cluster}</option>`);
                });
            }
        
        });

        const cityOptions = {
            'BALI BARAT': ['BULELENG','JEMBRANA','TABANAN'],
            'BALI TENGAH': ['BADUNG','KOTA DENPASAR'],
            'BALI TIMUR': ['BANGLI','GIANYAR','KARANG ASEM','KLUNGKUNG'],
            'ENDE SIKKA': ['ENDE','SIKKA'],
            'FLORES TIMUR': ['ALOR','FLORES TIMUR','LEMBATA'],
            'KUPANG ROTE': ['KOTA KUPANG','KUPANG','ROTE NDAO'],
            'MALAKA TIMTIM BELU': ['BELU','MALAKA','TIMOR TENGAH SELATAN','TIMOR TENGAH UTARA'],
            'MANGGARAI': ['MANGGARAI','MANGGARAI BARAT','MANGGARAI TIMUR','NAGEKEO','NGADA'],
            'SUMBA': ['SABU RAIJUA','SUMBA BARAT','SUMBA BARAT DAYA','SUMBA TENGAH','SUMBA TIMUR'],
            'LOMBOK': ['KOTA MATARAM','LOMBOK BARAT','LOMBOK TENGAH','LOMBOK TIMUR','LOMBOK UTARA'],
            'SUMBAWA BARAT': ['SUMBAWA','SUMBAWA BARAT'],
            'SUMBAWA TIMUR': ['BIMA','DOMPU','KOTA BIMA'],
        };

        $('#filter_cluster_admin').on('change', function() {
            let cluster = $(this).val();
            let cityDropdown = $('#filter_city_admin');
            
            cityDropdown.html('<option value="" selected disabled>City</option>');
        
            if (cityOptions[cluster]) {
                cityOptions[cluster].forEach(city => {
                    cityDropdown.append(`<option value="${city}">${city}</option>`);
                });
            }
        
        });

        $('#btn_dl_test_resultxx').click(function () {
            function exportTableToCSV(filename) {
                var csv = [];
                var rows = $('#dataTable thead, #dataTable tbody').find('tr');

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

            // Call the function with a file name
            const dateformat = new Date().toISOString().replace(/[-:.TZ]/g, '').slice(0, 14); // Format YYYYMMDDHHMMSS
            const exported_fname = `table_export_pnp_test_result_${dateformat}.csv`;
            exportTableToCSV(exported_fname);

        });

        $('#btn_dl_test_result').click(function () {
            function exportTableToCSV(filename) {
                var csv = [];
                var imageUrls = [];
                var rows = $('#dataTable thead, #dataTable tbody').find('tr');

                rows.each(function () {
                    var row = [];
                    $(this).find('th, td').each(function () {
                        var cellContent = $(this).text().trim();

                        var imgTag = $(this).find('img');
                        if (imgTag.length) {
                            var imgUrl = imgTag.attr('src');
                            if (imgUrl) {
                                imageUrls.push({ url: imgUrl, name: getFileNameFromUrl(imgUrl) });
                                cellContent = imgUrl; // Store image URL in CSV
                            }
                        }

                        row.push('"' + cellContent + '"');
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

                if (imageUrls.length > 0) {
                    downloadAndZipImages(imageUrls);
                } else {
                    alert("No images found in the table.");
                }
            }

            function downloadAndZipImages(imageList) {
                var zip = new JSZip();
                var folder = zip.folder("images");
                var promises = [];

                imageList.forEach((img) => {
                    var promise = fetchImage(img.url).then(blob => {
                        if (blob) {
                            folder.file(img.name, blob);
                        }
                    }).catch(error => console.error("Error downloading image:", error));

                    promises.push(promise);
                });

                Promise.all(promises).then(() => {
                    if (Object.keys(folder.files).length > 0) {
                        zip.generateAsync({ type: "blob" }).then(content => {
                            saveAs(content, "images.zip");
                        });
                    } else {
                        alert("No images could be downloaded.");
                    }
                });
            }

            async function fetchImage(url) {
                try {
                    if (url.startsWith("blob:")) {
                        return await convertBlobToImage(url);
                    } else {
                        const response = await fetch(url);
                        if (!response.ok) throw new Error(`Failed to fetch ${url}`);
                        return await response.blob();
                    }
                } catch (error) {
                    console.error("Fetch error:", error);
                    return null;
                }
            }

            async function convertBlobToImage(blobUrl) {
                return new Promise((resolve, reject) => {
                    var img = document.querySelector(`img[src="${blobUrl}"]`);
                    if (!img) return reject("Image not found");

                    var canvas = document.createElement("canvas");
                    var ctx = canvas.getContext("2d");
                    canvas.width = img.naturalWidth;
                    canvas.height = img.naturalHeight;
                    ctx.drawImage(img, 0, 0);

                    canvas.toBlob(blob => {
                        if (blob) resolve(blob);
                        else reject("Failed to convert blob to image");
                    }, "image/jpeg");
                });
            }

            function getFileNameFromUrl(url) {
                return url.split('/').pop() || `image_${Date.now()}.jpg`;
            }

            const dateformat = new Date().toISOString().replace(/[-:.TZ]/g, '').slice(0, 14);
            const exported_fname = `table_export_${dateformat}.csv`;
            exportTableToCSV(exported_fname);
        });

        $(".btn_score_detail").on("click",function(){
            let quizId = $(this).attr("id").split("btn_score_");
            
            $.ajax({
                type:"post",
                url :"<?php echo base_url(); ?>/pnp_test/get_score_detail",
                data: {
                    quizId : quizId[1]
                },
                dataType: "json",
                cache: false,
                beforeSend: function () {
                    $("#scoreDetailTableContainer").html('<div class="text-center text-muted">Loading...</div>');
                },
                success: function (data) 
                {
                    let rows = data.parse_score_detail;
                    let html = "";
                    console.log(data.parse_score_detail.length);

                    if (rows && rows.length > 0) {
                        html += `
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Jawaban</th>
                                            <th>Kunci</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        `;

                        rows.forEach((item, index) => {
                            // pewarnaan status
                            let statusColor = (item.Statement === "Benar") ? "text-success fw-bold" : "text-danger fw-bold";

                            html += `
                                <tr>
                                    <td>${item.no ?? '-'}</td>
                                    <td>${item.answer ?? '-'}</td>
                                    <td>${item.correct_option ?? '-'}</td>
                                    <td class="${statusColor}">${item.Statement ?? '-'}</td>
                                </tr>
                            `;
                        });

                        html += `
                                    </tbody>
                                </table>
                            </div>
                        `;
                    } else {
                        html = '<div class="text-center text-danger">Tidak ada data ditemukan.</div>';
                    }

                    $("#scoreDetailTableContainer").html(html);
                    $("#scoreDetailModal").modal('show');  
                },
                error: function () {
                    $("#scoreDetailTableContainer").html('<div class="text-center text-danger">Gagal memuat data.</div>');
                }
            });
        });

    });
</script>

<?php $this->endSection() ?>