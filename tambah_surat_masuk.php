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
            $_REQUEST['no_agenda'] == "" ||$_REQUEST['jenis_surat'] == "" || $_REQUEST['no_suratm'] == "" || $_REQUEST['asal_surat'] == "" || $_REQUEST['isi'] == ""
            || $_REQUEST['indeks'] == "" || $_REQUEST['tgl_surat'] == ""  
        ) {
            $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
            echo '<script language="javascript">window.history.back();</script>';
        } else {
            $no_agenda = $_REQUEST['no_agenda'];
            $jenis_surat = $_REQUEST['jenis_surat'];
            $no_suratm = $_REQUEST['no_suratm'];
            $asal_surat = $_REQUEST['asal_surat'];
            $isi = $_REQUEST['isi'];
            $indeks = $_REQUEST['indeks'];
            $tgl_surat = $_REQUEST['tgl_surat'];
            $id_user = $_SESSION['id_user'];

            //validasi input data
            if (!preg_match("/^[a-zA-Z0 ]*$/", $jenis_surat)) {
                $_SESSION['jenis_surat'] = 'Form Jenis Surat harus dipilih!';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if (!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_suratm)) {
                    $_SESSION['no_suratm'] = 'Form No Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {
                    if(!preg_match("/^[0-9]*$/", $no_agenda)){
                        $_SESSION['no_agenda'] = 'Form Nomor Agenda harus diisi angka!';
                        echo '<script language="javascript">window.history.back();</script>';
                    }else{

                    if (!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $asal_surat)) {
                        $_SESSION['asal_surat'] = 'Form Asal Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-),kurung() dan garis miring(/)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi)) {
                            $_SESSION['isi'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if (!preg_match("/^[a-zA-Z0-9., -]*$/", $indeks)) {
                                    $_SESSION['indeks'] = 'Form Indeks hanya boleh mengandung karakter huruf, angka, spasi, titik(.) dan koma(,) dan minus (-)';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    if (!preg_match("/^[0-9.-]*$/", $tgl_surat)) {
                                        $_SESSION['tgl_surat'] = 'Form Tanggal Surat hanya boleh mengandung angka dan minus(-)';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    } else {

                                            $cek = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE no_suratm='$no_suratm'");
                                            $result = mysqli_num_rows($cek);

                                            if ($result > 0) {
                                                $_SESSION['errDup'] = 'Nomor Surat sudah terpakai, gunakan yang lain!';
                                                echo '<script language="javascript">window.history.back();</script>';
                                            } else {

                                                $ekstensi = array('jpg', 'png', 'jpeg', 'doc', 'docx', 'pdf');
                                                $file = $_FILES['file']['name'];
                                                $x = explode('.', $file);
                                                $eks = strtolower(end($x));
                                                $ukuran = $_FILES['file']['size'];
                                                $target_dir = "upload/surat_masuk/";

                                                if (!is_dir($target_dir)) {
                                                    mkdir($target_dir, 0755, true);
                                                }

                                                //jika form file tidak kosong akan mengeksekusi script dibawah ini
                                                if ($file != "") {

                                                    $rand = rand(1, 10000);
                                                    $nfile = $rand . "-" . $file;

                                                    //validasi file
                                                    if (in_array($eks, $ekstensi) == true) {
                                                        if ($ukuran < 2500000) {

                                                            move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $nfile);

                                                            $query = mysqli_query($config, "INSERT INTO tbl_surat_masuk(no_agenda,no_suratm,asal_surat,isi,indeks,tgl_surat,
                                                                    tgl_diterima,file,id_user, jenis_surat)
                                                                        VALUES('$no_agenda','$no_suratm','$asal_surat','$isi','$indeks','$tgl_surat',NOW(),'$nfile','$id_user','$jenis_surat')");

                                                            if ($query == true) {
                                                                $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                                header("Location: ./admin.php?page=tsm");
                                                                die();
                                                            } else {
                                                                $_SESSION['errQ'] = 'ERROR! Ada masalah dengan queryyyyyyyyy';
                                                                echo '<script language="javascript">window.history.back();</script>';
                                                            }
                                                        } else {
                                                            $_SESSION['errSize'] = 'Ukuran file yang diupload terlalu besar!';
                                                            echo '<script language="javascript">window.history.back();</script>';
                                                        }
                                                    } else {
                                                        $_SESSION['errFormat'] = 'Format file yang diperbolehkan hanya *.JPG, *.PNG, *.DOC, *.DOCX atau *.PDF!';
                                                        echo '<script language="javascript">window.history.back();</script>';
                                                    }
                                                } else {

                                                    //jika form file kosong akan mengeksekusi script dibawah ini
                                                    $query = mysqli_query($config, "INSERT INTO tbl_surat_masuk(no_agenda,no_suratm,asal_surat,isi,kode,indeks,tgl_surat, tgl_diterima,file,id_user,jenis_surat)
                                                            VALUES('$no_agenda','$no_suratm','$asal_surat','$isi','$nkode','$indeks','$tgl_surat',NOW(),'','$id_user','$jenis_surat')");

                                                    if ($query == true) {
                                                        $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                        header("Location: ./admin.php?page=tsm");
                                                        die();
                                                    } else {
                                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan queryyyyyyyyyyyyyyyyy';
                                                        echo '<script language="javascript">window.history.back();</script>';
                                                    }
                                                }
                                            }
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
                            <li class="waves-effect waves-light"><a href="?page=tsm&act=add" class="judul"><i class="material-icons">mail</i> Tambah Data Surat Masuk</a></li>
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
                            <i class="material-icons prefix md-prefix">looks_one</i>
                            <?php
                            echo '<input id="no_agenda" type="number" class="validate" name="no_agenda" value="';
                                $sql = mysqli_query($config, "SELECT no_agenda FROM tbl_surat_masuk");
                                $no_agenda = "1";
                                if (mysqli_num_rows($sql) == 0){
                                    echo $no_agenda;
                                }

                                $result = mysqli_num_rows($sql);
                                $counter = 0;
                                while(list($no_agenda) = mysqli_fetch_array($sql)){
                                    if (++$counter == $result) {
                                        $no_agenda++;
                                        echo $no_agenda;
                                    }
                                }
                                echo '" required>';

                                if(isset($_SESSION['no_agenda'])){
                                    $no_agenda = $_SESSION['no_agenda'];
                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_agenda.'</div>';
                                    unset($_SESSION['no_agenda']);
                                }
                            ?>
                            <label for="no_agenda">Nomor Agenda</label>
                        </div>
                
        <div class="input-field col s6">
            <i class="material-icons prefix md-prefix">place</i>
            <input id="asal_surat" type="text" class="validate" name="asal_surat" required>
            <?php
            if (isset($_SESSION['asal_surat'])) {
                $asal_surat = $_SESSION['asal_surat'];
                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $asal_surat . '</div>';
                unset($_SESSION['asal_surat']);
            }
            ?>
            <label for="asal_surat">Asal Surat</label>
        </div>
        
        <div class="input-field col s6">
            <i class="material-icons prefix md-prefix">storage</i>
            <input id="indeks" type="text" class="validate" name="indeks" required>
            <?php
            if (isset($_SESSION['indeks'])) {
                $indeks = $_SESSION['indeks'];
                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $indeks . '</div>';
                unset($_SESSION['indeks']);
            }
            ?>
            <label for="indeks">Indeks Berkas</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix md-prefix">looks_two</i>
            <input id="no_suratm" type="text" class="validate" name="no_suratm" required>
            <?php
            if (isset($_SESSION['no_suratm'])) {
                $no_suratm = $_SESSION['no_suratm'];
                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $no_suratm . '</div>';
                unset($_SESSION['no_suratm']);
            }
            if (isset($_SESSION['errDup'])) {
                $errDup = $_SESSION['errDup'];
                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $errDup . '</div>';
                unset($_SESSION['errDup']);
            }
            ?>
            <label for="no_suratm">Nomor Surat</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix md-prefix">date_range</i>
            <input id="tgl_surat" type="text" name="tgl_surat" class="datepicker" required>
            <?php
            if (isset($_SESSION['tgl_surat'])) {
                $tgl_surat = $_SESSION['tgl_surat'];
                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $tgl_surat . '</div>';
                unset($_SESSION['tgl_surat']);
            }
            ?>
            <label for="tgl_surat">Tanggal Surat</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix md-prefix">description</i>
            <textarea id="isi" class="materialize-textarea validate" name="isi" required></textarea>
            <?php
            if (isset($_SESSION['isi'])) {
                $isi = $_SESSION['isi'];
                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $isi . '</div>';
                unset($_SESSION['isi']);
            }
            ?>
            <label for="isi">Isi Ringkas</label>
        </div>

        <div class="input-field col s6">
            <div class="file-field input-field">
                <div class="btn light-green darken-1">
                    <span>File</span>
                    <input type="file" id="file" name="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload file/scan gambar surat masuk">
                    <?php
                    if (isset($_SESSION['errSize'])) {
                        $errSize = $_SESSION['errSize'];
                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $errSize . '</div>';
                        unset($_SESSION['errSize']);
                    }
                    if (isset($_SESSION['errFormat'])) {
                        $errFormat = $_SESSION['errFormat'];
                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $errFormat . '</div>';
                        unset($_SESSION['errFormat']);
                    }
                    ?>
                    <small class="red-text">*Format file yang diperbolehkan *.JPG, *.PNG, *.DOC, *.DOCX, *.PDF dan ukuran maksimal file 2 MB!</small>
                </div>
            </div>
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