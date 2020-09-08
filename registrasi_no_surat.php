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
            $_REQUEST['jenis_surat'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['klasifikasi'] == "" || $_REQUEST['klasifikasi1'] == "" || $_REQUEST['tgl_ajukan'] == ""   
        ) {
            $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
            echo '<script language="javascript">window.history.back();</script>';
        } else {
            $jenis_surat = $_REQUEST['jenis_surat'];
            $no_surat = $_REQUEST['no_surat'];
            $klasifikasi = $_REQUEST['klasifikasi'];
            $klasifikasi1 = $_REQUEST['klasifikasi1'];
            $tgl_ajukan = $_REQUEST['tgl_ajukan'];
            $id = $_SESSION['id'];

            //validasi input data
            if (!preg_match("/^[a-zA-Z0 ]*$/", $jenis_surat)) {
                $_SESSION['jenis_surat'] = 'Form Jenis Surat harus dipilih!';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if (!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)) {
                    $_SESSION['no_surat'] = 'Form No Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if (!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $klasifikasi)) {
                        $_SESSION['asal_surat'] = 'Form klasifikasi harus dipilih';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $klasifikasi1)) {
                            $_SESSION['isi'] = 'Form klasifikasi harus dipilih';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                                    if (!preg_match("/^[0-9.-]*$/", $tgl_ajukan)) {
                                        $_SESSION['tgl_ajukan'] = 'Form Tanggal ajukan hanya boleh mengandung angka dan minus(-)';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    } else {

                                            $cek = mysqli_query($config, "SELECT * FROM tbl_nomor_surat WHERE no_surat='$no_surat'");
                                            $result = mysqli_num_rows($cek);

                                            if ($result > 0) {
                                                $_SESSION['errDup'] = 'Nomor Surat sudah terpakai, gunakan yang lain!';
                                                echo '<script language="javascript">window.history.back();</script>';
                                             
                                                            $query = mysqli_query($config, "INSERT INTO tbl_nomor_surat(jenis_surat,no_surat,klasifikasi,klasifikasi1,tgl_ajukan,id)
                                                                    VALUES('$jenis_surat','$no_surat','$klasifikasi','$klasifikasi1','$tgl_ajukan','$id')");

                                                            if ($query == true) {
                                                                $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                                header("Location: ./admin.php?page=tsm");
                                                                die();
                                                            } else {
                                                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                                                echo '<script language="javascript">window.history.back();</script>';
                                                            }
                                                        } else {

                                                    //jika form file kosong akan mengeksekusi script dibawah ini
                                                    $query = mysqli_query($config, "INSERT INTO tbl_nomor_surat(jenis_surat,no_surat,klasifikasi,klasifikasi1,tgl_ajukan,id)
                                                            VALUES('$jenis_surat','$no_surat','$klasifikasi','$klasifikasi1','$tgl_ajukan','$id')");

                                                    if ($query == true) {
                                                        $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                        header("Location: ./admin.php?page=tsm");
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
                            <li class="waves-effect waves-light"><a href="?page=tsm&act=add" class="judul"><i class="material-icons">mail</i>  Registrasi Nomor Surat</a></li>
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
            <form class="col s12" method="POST" action="?page=tsm&act=add" enctype="multipart/form-data">

                <!-- Row in form START -->
                <div class="input-field col s6">
            <i class="material-icons prefix md-prefix">looks_two</i>
            <input id="no_surat" type="text" class="validate" name="no_surat" required>
            <?php
            if (isset($_SESSION['no_surat'])) {
                $no_surat = $_SESSION['no_surat'];
                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $no_surat . '</div>';
                unset($_SESSION['no_surat']);
            }
            if (isset($_SESSION['errDup'])) {
                $errDup = $_SESSION['errDup'];
                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $errDup . '</div>';
                unset($_SESSION['errDup']);
            }
            ?>
            <label for="no_surat">Nomor Surat</label>
        </div>

        <div class="input-field col s6">
            <i class="material-icons prefix md-prefix">place</i>
            <input id="jenis_surat" type="text" class="validate" name="jenis_surat" required>
            <?php
            if (isset($_SESSION['jenis_surat'])) {
                $asal_surat = $_SESSION['jenis_surat'];
                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $jenis_surat . '</div>';
                unset($_SESSION['jenis_surat']);
            }
            ?>
            <label for="asal_surat">Jenis Surat</label>
        </div>
        
        <div class="input-field col s6">
            <i class="material-icons prefix md-prefix">storage</i>
            <input id="klasifikasi" type="text" class="validate" name="klasifikasi" required>
            <?php
            if (isset($_SESSION['klasifikasi'])) {
                $klasifikasi = $_SESSION['klasifikasi'];
                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $klasifikasi . '</div>';
                unset($_SESSION['klasifikasi']);
            }
            ?>
            <label for="klasifikasi">klasifikasi Berkas</label>
        </div>
        
        <div class="input-field col s6">
            <i class="material-icons prefix md-prefix">date_range</i>
            <input id="tgl_ajukan" type="text" name="tgl_ajukan" class="datepicker" required>
            <?php
            if (isset($_SESSION['tgl_ajukan'])) {
                $tgl_surat = $_SESSION['tgl_ajukan'];
                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $tgl_ajukan . '</div>';
                unset($_SESSION['tgl_ajukan']);
            }
            ?>
            <label for="tgl_ajukan">Tanggal Surat</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix md-prefix">description</i>
            <textarea id="klasifikasi1" class="materialize-textarea validate" name="klasifikasi1" required></textarea>
            <?php
            if (isset($_SESSION['klasifikasi1'])) {
                $isi = $_SESSION['klasifikasi1'];
                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $isi . '</div>';
                unset($_SESSION['klasifikasi1']);
            }
            ?>
            <label for="klasifikasi1">Klasifikasi 1</label>
        </div>
                      
        <!-- Row in form END -->

        <div class="row">
            <div class="col 6">
                <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
            </div>
            <div class="col 6">
                <a href="?page=tsm" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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