<?php
//cek session
if (empty($_SESSION['admin'])) {
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {

    if (isset($_REQUEST['submit'])) {

        //validasi form kosong
        if (
            $_REQUEST['no_surat'] == "" || $_REQUEST['klasifikasi'] == "" || $_REQUEST['klasifikasi1'] == "" || $_REQUEST['tgl_surat'] == ""  || $_REQUEST['jenis_surat'] == ""
        ) {
            $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi brooooo';
            echo '<script language="javascript">window.history.back();</script>';
        } else {

            $no_surat = $_REQUEST['no_surat'];
            $klasifikasi = $_REQUEST['klasifikasi'];
            $klasifikasi1 = $_REQUEST['klasifikasi1'];
            $tgl_surat = $_REQUEST['tgl_surat'];
            $jenis_surat = $_REQUEST['jenis_surat'];
            $id_user = $_SESSION['id_user'];


            //validasi input data
            if (!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)) {
                $_SESSION['no_suratr'] = 'Form No Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if (!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $klasifikasi)) {
                    $_SESSION['klasifikasi'] = 'Form Tujuan Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), kurung() dan garis miring(/)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $klasifikasi1)) {
                        $_SESSION['klasifikasi1'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {



                        if (!preg_match("/^[0-9.-]*$/", $tgl_surat)) {
                            $_SESSION['tgl_suratr'] = 'Form Tanggal Surat hanya boleh mengandung angka dan minus(-)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if (!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $jenis_surat)) {
                                $_SESSION['jenis_suratr'] = 'Form jenis_surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan kurung()';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                $cek = mysqli_query($config, "SELECT * FROM tbl_nomor_surat WHERE no_surat='$no_surat'");
                                $result = mysqli_num_rows($cek);

                                if ($result > 0) {
                                    $_SESSION['errDup'] = 'Nomor Surat sudah terpakai, gunakan yang lain!';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {


                                    $query = mysqli_query($config, "INSERT INTO tbl_nomor_surat(no_surat,klasifikasi,klasifikasi1,tgl_surat,id_user,jenis_surat)
                                                VALUES('$no_surat','$klasifikasi','$klasifikasi1','$tgl_surat','$id_user','$jenis_surat')");

                                    if ($query == true) {
                                        $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                        header("Location: ./admin.php?page=ns");
                                        die();
                                    } else {
                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    } else { ?>

        <!-- Row Start -->
        <div class="row">
            <!-- Secondary Nav START -->
            <div class="col s12">
                <nav class="secondary-nav">
                    <div class="nav-wrapper blue-grey darken-1">
                        <ul class="left">
                            <li class="waves-effect waves-light"><a href="?page=rns&act=add" class="judul"><i class="material-icons">drafts</i> Tambah Data Surat Keluar</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- Secondary Nav END -->
        </div>
        <!-- Row END -->

        <?php
        if (isset($_SESSION['errQ'])) {
            $errQ = $_SESSION['errQ'];
            echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> ' . $errQ . '</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
            unset($_SESSION['errQ']);
        }
        if (isset($_SESSION['errEmpty'])) {
            $errEmpty = $_SESSION['errEmpty'];
            echo '<div id="alert-message" class="row">
                            <div class="col m12">
                                <div class="card red lighten-5">
                                    <div class="card-content notif">
                                        <span class="card-title red-text"><i class="material-icons md-36">clear</i> ' . $errEmpty . '</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
            unset($_SESSION['errEmpty']);
        }
        ?>

        <!-- Row form Start -->
        <div class="row jarak-form">

            <!-- Form START -->
            <form class="col s12" method="POST" action="?page=rns&act=add" enctype="multipart/form-data">

                <!-- Row in form START -->
                <div class="row">


                         <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">looks_two</i>
                            <input id="no_surat" type="text" class="validate" name="no_surat" required>
                                <?php
                                    if(isset($_SESSION['no_suratr'])){
                                        $no_suratr = $_SESSION['no_suratr'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_suratr.'</div>';
                                        unset($_SESSION['no_suratr']);
                                    }
                                    if(isset($_SESSION['errDup'])){
                                        $errDup = $_SESSION['errDup'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$errDup.'</div>';
                                        unset($_SESSION['errDup']);
                                    }
                                ?>
                            <label for="no_surat">Nomor Surat</label>
                        </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">date_range</i>
                        <input id="tgl_surat" type="text" name="tgl_surat" class="datepicker" required>
                        <?php
                        if (isset($_SESSION['tgl_suratr'])) {
                            $tgl_suratr = $_SESSION['tgl_suratr'];
                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $tgl_suratr . '</div>';
                            unset($_SESSION['tgl_suratr']);
                        }
                        ?>
                        <label for="tgl_surat">Tanggal Surat</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">klasifikasi</i>
                        <textarea id="klasifikasi" class="materialize-textarea validate" name="klasifikasi" required></textarea>
                        <?php
                        if (isset($_SESSION['klasifikasi'])) {
                            $klasifikasi = $_SESSION['klasifikasi'];
                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $klasifikasi . '</div>';
                            unset($_SESSION['klasifikasi']);
                        }
                        ?>
                        <label for="isi">Klasifikasi</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">klasifikasi1</i>
                        <textarea id="klasifikasi1" class="materialize-textarea validate" name="klasifikasi1" required></textarea>
                        <?php
                        if (isset($_SESSION['klasifikasi1'])) {
                            $klasifikasi = $_SESSION['klasifikasi1'];
                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $klasifikasi1 . '</div>';
                            unset($_SESSION['klasifikasi1']);
                        }
                        ?>
                        <label for="isi">Klasifikasi 1</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">low_priority</i><label>Jenis Surat</label><br />
                        <div class="input-field col s11 right">
                            <select class="browser-default validate" name="jenis_surat" id="jenis_surat" required>
                                <?php
                                $sql = mysqli_query($config, "SELECT nama FROM tbl_jenis");
                                while ($data = mysqli_fetch_array($sql))
                                    echo '<option value=' . $data['nama'] . '>' . $data['nama'] . '</option>';
                                ?>
                            </select>
                        </div>
                        <?php
                        if (isset($_SESSION['jenis_surat'])) {
                            $sifat = $_SESSION['jenis_surat'];
                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $sifat . '</div>';
                            unset($_SESSION['jenis_surat']);
                        }
                        ?>
                    </div>
                </div>
                <!-- Row in form END -->

                <div class="row">
                    <div class="col 6">
                        <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                    </div>
                    <div class="col 6">
                        <a href="?page=rns" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
                    </div>
                </div>

            </form>
            <!-- Form END -->

        </div>
        <!-- Row form END -->

<?php
    }
}
?>