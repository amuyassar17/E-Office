DROP TABLE tbl_disposisi;

CREATE TABLE `tbl_disposisi` (
  `id_disposisi` int(10) NOT NULL AUTO_INCREMENT,
  `tujuan` mediumtext NOT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(100) NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_disposisi`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO tbl_disposisi VALUES("2","Rektor","hghgjhgghjgh","Penting","2020-09-09","gfghfh","6","1");
INSERT INTO tbl_disposisi VALUES("4","Kemenag","assdasddas
asdasdas
sdasdas
asdasdas
sdasd","Biasa","2020-09-03","dasdas","8","1");



DROP TABLE tbl_instansi;

CREATE TABLE `tbl_instansi` (
  `id_instansi` tinyint(1) NOT NULL,
  `institusi` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `pimpinan` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_instansi VALUES("1","Kementerian Pendidikan dan Kebudayaan","Universitas Negeri Makassar Fakultas Bahasa dan Sastra","Terakreditasi A","Pettarani","Ahmad Muyassar Ibrahim","60200114065","https://unm.com","amuyassar@gmail.com","Logo-Besar.png","1");



DROP TABLE tbl_jenis;

CREATE TABLE `tbl_jenis` (
  `id_jenis` int(5) NOT NULL AUTO_INCREMENT,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO tbl_jenis VALUES("12","A1","Perintah","Surat Perintah ......","1");
INSERT INTO tbl_jenis VALUES("13","A2","Pengantar","Surat Pengantar ......","1");
INSERT INTO tbl_jenis VALUES("14","A3","Undangan","Surat Undangan ......","1");
INSERT INTO tbl_jenis VALUES("15","A4","Tugas","Surat Tugas ......","1");
INSERT INTO tbl_jenis VALUES("16","A5","Izin","Surat Izin","1");



DROP TABLE tbl_nomor_surat;

CREATE TABLE `tbl_nomor_surat` (
  `no_surat` varchar(30) NOT NULL,
  `jenis_surat` varchar(30) NOT NULL,
  `klasifikasi` varchar(30) NOT NULL,
  `klasifikasi1` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `id_ns` int(5) NOT NULL AUTO_INCREMENT,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_ns`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO tbl_nomor_surat VALUES("dasdasd","Tugas","dasdas","dsadas","2020-09-10","1","1");
INSERT INTO tbl_nomor_surat VALUES("123dttr","Pengantar","kjkjdkasd ","asdasdasd","2020-09-10","2","1");
INSERT INTO tbl_nomor_surat VALUES("33dd4","Perintah","sasd","dsadasd","2020-09-07","3","1");
INSERT INTO tbl_nomor_surat VALUES("3/2/Tugas-2020-09","Tugas","3","2","2020-09-11","9","1");



DROP TABLE tbl_sett;

CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `surat_masuk` tinyint(2) NOT NULL,
  `surat_keluar` tinyint(2) NOT NULL,
  `referensi` tinyint(2) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  `no_surat` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_sett`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_sett VALUES("1","10","10","10","1","10");



DROP TABLE tbl_surat_keluar;

CREATE TABLE `tbl_surat_keluar` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(10) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `isi` mediumtext NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_catat` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `jenis_surat` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_keluar VALUES("2","1","fakultas syariah","323d234","dfsdfs","2020-09-01","2020-09-01","5454-8617-DH RASET WSD 86 JULI  2020.doc","dasdasd","1");
INSERT INTO tbl_surat_keluar VALUES("3","2","dasda","asdasd","asdasdasd
dasdas
asdasd","2020-09-08","2020-09-08","162-Group 16755.png","asdasd","1");
INSERT INTO tbl_surat_keluar VALUES("4","3","fd","sdfsdf","fsdfsdf","2020-09-07","2020-09-08","2092-Group 16780.png","Tugas","1");
INSERT INTO tbl_surat_keluar VALUES("11","4","Pemda","01-459893-ppa","ddsadsa
sdasd
asdas","2020-09-12","2020-09-24","7648-surat masuk1.jpg","Tugas","1");
INSERT INTO tbl_surat_keluar VALUES("12","5","Rektor","3/2/Tugas-2020-09","A","2020-09-11","2020-09-25","3064-surat masuk.jpg","Tugas","1");



DROP TABLE tbl_surat_masuk;

CREATE TABLE `tbl_surat_masuk` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(10) NOT NULL,
  `no_suratm` varchar(50) NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `isi` mediumtext NOT NULL,
  `indeks` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  `jenis_surat` varchar(30) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_masuk VALUES("14","1","1/2/Perintah-2020-09","Dinas Pendidikan","Untuk.......","AC2","2020-09-16","2020-09-23","3193-surat masuk.jpg","1","Undangan");
INSERT INTO tbl_surat_masuk VALUES("15","2","2/1/Undangan-1899-11","Dinas Olahraga","Diharapkan untuk ......","AC1","2020-08-19","2020-09-23","19-surat masuk2.jpg","1","Tugas");
INSERT INTO tbl_surat_masuk VALUES("18","3","1/2/Perintah-2020-08","Pemda","Aku","4A","2020-09-24","2020-09-24","9602-surat masuk.jpg","1","Pengantar");



DROP TABLE tbl_user;

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO tbl_user VALUES("1","ahmad","61243c7b9a4022cb3f8dc3106767ed12","Ahmad Muyassar Ibrahim","-","1");
INSERT INTO tbl_user VALUES("2","admin","21232f297a57a5a743894a0e4a801fc3","Ahmad Muyassar","448684","2");
INSERT INTO tbl_user VALUES("4","acca17","5aa5ccfb08a3fe0e9999f1f14327b9b5","ahmad","12345678","3");



