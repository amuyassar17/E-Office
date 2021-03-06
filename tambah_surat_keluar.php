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
            $_REQUEST['no_agenda'] == "" || $_REQUEST['no_surat'] == "" || $_REQUEST['tujuan'] == "" || $_REQUEST['isi'] == ""
            || $_REQUEST['tgl_surat'] == ""  || $_REQUEST['jenis_surat'] == ""
        ) {
            $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
            echo '<script language="javascript">window.history.back();</script>';
        } else {

            $no_agenda = $_REQUEST['no_agenda'];
            $no_surat = $_REQUEST['no_surat'];
            $tujuan = $_REQUEST['tujuan'];
            $isi = $_REQUEST['isi'];


            $tgl_surat = $_REQUEST['tgl_surat'];
            $jenis_surat = $_REQUEST['jenis_surat'];
            $id_user = $_SESSION['id_user'];

            //validasi input data
            if (!preg_match("/^[0-9]*$/", $no_agenda)) {
                $_SESSION['no_agendak'] = 'Form Nomor Agenda harus diisi angka!';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                if (!preg_match("/^[a-zA-Z0-9.\/ -]*$/", $no_surat)) {
                    $_SESSION['no_suratk'] = 'Form No Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), minus(-) dan garis miring(/)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if (!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $tujuan)) {
                        $_SESSION['tujuan_surat'] = 'Form Tujuan Surat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), kurung() dan garis miring(/)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi)) {
                            $_SESSION['isik'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $jenis_surat)) {
                                $_SESSION['jenis_suratk'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {


                            if (!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $tgl_surat)) {
                                $_SESSION['tgl_suratk'] = 'Form Isi Ringkas hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), kurung(), underscore(_), dan(&) persen(%) dan at(@)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                               
                                    $cek = mysqli_query($config, "SELECT no_surat FROM tbl_surat_keluar WHERE no_surat='$no_surat'");
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
                                        $target_dir = "upload/surat_keluar/";

                                        if (!is_dir($target_dir)) {
                                            mkdir($target_dir, 0755, true);
                                        }

                                        //jika form file tidak kosong akan mengekse
                                        if ($file != "") {

                                            $rand = rand(1, 10000);
                                            $nfile = $rand . "-" . $file;
                                            if (in_array($eks, $ekstensi) == true) {
                                                if ($ukuran < 2500000) {

                                                    move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $nfile);

                                                    $query = mysqli_query($config, "INSERT INTO tbl_surat_keluar(no_agenda,tujuan,no_surat,isi,tgl_surat,
                                                                tgl_catat,file,jenis_surat,id_user)
                                                                VALUES('$no_agenda','$tujuan','$no_surat','$isi','$tgl_surat',NOW(),'$nfile','$jenis_surat','$id_user')");

                                                    if ($query == true) {
                                                        $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                        header("Location: ./admin.php?page=tsk");
                                                        die();
                                                    } else {
                                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
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
                                            $query = mysqli_query($config, "INSERT INTO tbl_surat_keluar(no_agenda,tujuan,no_surat,isi,tgl_surat,
                                                        tgl_catat,file,jenis_surat,id_user)
                                                        VALUES('$no_agenda','$tujuan','$no_surat','$isi','$tgl_surat',NOW(),'','$jenis_surat','$id_user')");

                                            if ($query == true) {
                                                $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan';
                                                header("Location: ./admin.php?page=tsk");
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
                            <li class="waves-effect waves-light"><a href="?page=tsk&act=add" class="judul"><i class="material-icons">drafts</i> Tambah Data Surat Keluar</a></li>
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
            <form class="col s12" method="POST" action="?page=tsk&act=add" enctype="multipart/form-data">

                <!-- Row in form START -->
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">looks_one</i>
                        <?php
                        echo '<input id="no_agenda" type="number" class="validate" name="no_agenda" value="';
                        $sql = mysqli_query($config, "SELECT no_agenda FROM tbl_surat_keluar");
                        $no_agenda = "1";
                        if (mysqli_num_rows($sql) == 0) {
                            echo $no_agenda;
                        }

                        $result = mysqli_num_rows($sql);
                        $counter = 0;
                        while (list($no_agenda) = mysqli_fetch_array($sql)) {
                            if (++$counter == $result) {
                                $no_agenda++;
                                echo $no_agenda;
                            }
                        }
                        echo '" required>';

                        if (isset($_SESSION['no_agendak'])) {
                            $no_agendak = $_SESSION['no_agendak'];
                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $no_agendak . '</div>';
                            unset($_SESSION['no_agendak']);
                        }
                        ?>
                        <label for="no_agenda">Nomor Agenda</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">place</i>
                        <input id="tujuan" type="text" class="validate" name="tujuan" required>
                        <?php
                        if (isset($_SESSION['tujuan_surat'])) {
                            $tujuan_surat = $_SESSION['tujuan_surat'];
                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $tujuan_surat . '</div>';
                            unset($_SESSION['tujuan_surat']);
                        }
                        ?>
                        <label for="tujuan">Tujuan Surat</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">low_priority</i><label>Nomor Surat</label><br />
                        <div class="input-field col s11 right">
                            <select class="browser-default validate" name="no_surat" id="no_suratk" required>
                                <?php
                                $sql = mysqli_query($config, "SELECT * FROM tbl_nomor_surat");
                                while ($data = mysqli_fetch_array($sql))
                                    echo '<option data-tgl='.$data['tgl_surat'].' data-jenis='.$data['jenis_surat'].' value=' . $data['no_surat'] . '>' . $data['no_surat'] . '</option>';
                                ?>
                            </select>
                        </div>
                        <?php
                        if (isset($_SESSION['no_surat'])) {
                            $nomor = $_SESSION['no_surat'];
                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $nomor . '</div>';
                            unset($_SESSION['no_surat']);
                        }
                        ?>
                    </div>
                    
                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">date_range</i>
                        <input id="tgl_suratk" type="text" name="tgl_surat" class="validate" readonly required>
                        <?php
                        if (isset($_SESSION['tgl_suratk'])) {
                            $tgl_suratk = $_SESSION['tgl_suratk'];
                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $tgl_suratk . '</div>';
                            unset($_SESSION['tgl_suratk']);
                        }
                        ?>
                        <label class="active" for="tgl_surat">Tanggal Surat</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix md-prefix">description</i>
                        <textarea id="isi" class="materialize-textarea validate" name="isi" required></textarea>
                        <?php
                        if (isset($_SESSION['isik'])) {
                            $isik = $_SESSION['isik'];
                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $isik . '</div>';
                            unset($_SESSION['isik']);
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
                                <input class="file-path validate" type="text" placeholder="Upload file/scan gambar surat keluar">
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
                        <i class="material-icons prefix md-prefix">description</i>
                        <input id="jenis_surat" type="text" class="validate" name="jenis_surat" readonly required>
                        <?php
                        if (isset($_SESSION['jenis_suratk'])) {
                            $jenis_suratk = $_SESSION['jenis_suratk'];
                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">' . $jenis_suratk . '</div>';
                            unset($_SESSION['jenis_suratk']);
                        }
                        ?>
                        <label class="active" for="jenis_surat">Jenis Surat</label>
                    </div>
                </div>
                <!-- Row in form END -->

                <div class="row">
                    <div class="col 6">
                        <button type="submit" name="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                    </div>
                    <div class="col 6">
                        <a href="?page=tsk" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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