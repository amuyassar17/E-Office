<?php
//cek session
if (!empty($_SESSION['admin'])) {
?>

    <noscript>
        <meta http-equiv="refresh" content="0;URL='./enable-javascript.html'" />
    </noscript>

    <!-- Footer START -->
    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <br />
            </div>
        </div>
        <div class="footer-copyright blue-grey darken-1 white-text">
            <div class="container" id="footer">
                <?php
                $query = mysqli_query($config, "SELECT * FROM tbl_instansi");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <span class="white-text copyright-date">&copy; <?php echo date("Y"); ?> <?php echo $data['nama'] . '</span>
                '; ?>
                    <?php } ?>
            </div>
        </div>
    </footer>
    <!-- Footer END -->

    <!-- Javascript START -->
    <script type="text/javascript" src="asset/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="asset/js/materialize.min.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="asset/js/jquery.autocomplete.min.js"></script>
    <!-- <script data-pace-options='{ "ajax": false }' src='asset/js/pace.min.js'></script> -->
    <script>
        $("#klasifikasi").on("change", function() {
            let kla = $("#klasifikasi").val()
            let kla1 = ($("#klasifikasi1").val() ? $("#klasifikasi1").val() : '')
            let tanggal = $("#tgl_surat").val();
            let date = tanggal.split("-", 2);
            let jenis = $("#jenis_surat").val()
            $("#no_surat").val(kla + "/" + kla1 + "/" + jenis + "-" + date[0] + "-" + date[1]);
        })
        $("#klasifikasi1").on("change", function() {
            let kla = $("#klasifikasi").val()
            let kla1 = $("#klasifikasi1").val()
            let tanggal = $("#tgl_surat").val();
            let date = tanggal.split("-", 2);
            let jenis = $("#jenis_surat").val()
            $("#no_surat").val(kla + "/" + kla1 + "/" + jenis + "-" + date[0] + "-" + date[1]);
        })
        $("#tgl_surat").on("change", function() {
            let kla = $("#klasifikasi").val()
            let kla1 = $("#klasifikasi1").val()
            let jenis = $("#jenis_surat").val()
            let tanggal = $("#tgl_surat").val();
            let date = tanggal.split("-", 2);
            $("#no_surat").val(kla + "/" + kla1 + "/" + jenis + "-" + date[0] + "-" + date[1]);

        })
        $("#jenis_surat").on("change", function() {
            let kla = $("#klasifikasi").val()
            let kla1 = $("#klasifikasi1").val()
            let jenis = $("#jenis_surat").val()
            let tanggal = $("#tgl_surat").val();
            let date = tanggal.split("-", 2);
            $("#no_surat").val(kla + "/" + kla1 + "/" + jenis + "-" + date[0] + "-" + date[1]);

        })
        $(document).on("change", "#no_suratk", function() {
            var jenis = $(this).find(':selected').attr('data-jenis')
            var tgl = $(this).find(':selected').attr('data-tgl')
            var nomor = $(this).find(':selected').attr('value')
            $.ajax({
                //data :{action: "showroom"},
                url: "index.php", //php page URL where we post this data to view from database
                type: 'POST',
                data : nomor,
                success: function(data) {
                    $("#content").html(data);
                }
            });
            // alert(jenis);
            $("#jenis_surat").val(jenis);
            $("#tgl_suratk").val(tgl);
            if (nomor == 'dasdasd')
                alert('nomor telah digunakan');

        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            //jquery dropdown
            $(".dropdown-button").dropdown({
                hover: false
            });

            //jquery sidenav on mobile
            $('.button-collapse').sideNav({
                menuWidth: 240,
                edge: 'left',
                closeOnClick: true
            });

            //jquery datepicker
            $('#tgl_surat,#batas_waktu,#dari_tanggal,#sampai_tanggal').pickadate({
                selectMonths: true,
                selectYears: 10,
                format: "yyyy-mm-dd"
            });

            //jquery teaxtarea
            $('#isi_ringkas').val('');
            $('#isi_ringkas').trigger('autoresize');

            //jquery dropdown select dan tooltip
            $('select').material_select();
            $('.tooltipped').tooltip({
                delay: 10
            });

            //jquery autocomplete
            $("#kode").autocomplete({
                serviceUrl: "kode.php", // Kode php untuk prosesing data.
                dataType: "JSON", // Tipe data JSON.
                onSelect: function(suggestion) {
                    $("#kode").val(suggestion.kode);
                }
            });

            //jquery untuk menampilkan pemberitahuan
            $("#alert-message").alert().delay(5000).fadeOut('slow');

            //jquery modal
            $('.modal-trigger').leanModal();
        });
    </script>
    <!-- Javascript END -->

<?php
} else {
    header("Location: ../");
    die();
}
?>5