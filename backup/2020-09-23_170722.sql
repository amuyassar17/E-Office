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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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

INSERT INTO tbl_instansi VALUES("1","Kementerian Pendidikan dan Kebudayaan","Universitas Negeri Makassar","Terakreditasi A","Pettarani","Ahmad Muyassar","60200114065","https://unm.com","amuyassar@gmail.com","Logo-Besar.png","1");



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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO tbl_nomor_surat VALUES("dasdasd","Tugas","dasdas","dsadas","2020-09-10","1","1");
INSERT INTO tbl_nomor_surat VALUES("123dttr","Pengantar","kjkjdkasd ","asdasdasd","2020-09-10","2","1");
INSERT INTO tbl_nomor_surat VALUES("33dd4","Perintah","sasd","dsadasd","2020-09-07","3","1");
INSERT INTO tbl_nomor_surat VALUES("01-459893-ppa","Tugas","sdaadasd","1","2020-09-12","4","1");
INSERT INTO tbl_nomor_surat VALUES("sdasd","Tugas","sdsadasd","Option 1","2020-09-10","5","1");
INSERT INTO tbl_nomor_surat VALUES("1/1/Tugas-2020-09","Tugas","1","1","2020-09-11","6","1");
INSERT INTO tbl_nomor_surat VALUES("$no_surat","$jenis_surat","$klasifikasi","$klasifikasi1","0000-00-00","7","0");
INSERT INTO tbl_nomor_surat VALUES("1/2/Undangan-2020-09","Undangan","1","2","2020-09-18","8","1");



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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_keluar VALUES("2","1","fakultas syariah","323d234","dfsdfs","2020-09-01","2020-09-01","5454-8617-DH RASET WSD 86 JULI  2020.doc","dasdasd","1");
INSERT INTO tbl_surat_keluar VALUES("3","2","dasda","asdasd","asdasdasd
dasdas
asdasd","2020-09-08","2020-09-08","162-Group 16755.png","asdasd","1");
INSERT INTO tbl_surat_keluar VALUES("4","3","fd","sdfsdf","fsdfsdf","2020-09-07","2020-09-08","2092-Group 16780.png","Tugas","1");
INSERT INTO tbl_surat_keluar VALUES("5","4","C","A","B","2020-09-06","2020-09-08","8056-Rectangle 6307.png","Perintah","1");
INSERT INTO tbl_surat_keluar VALUES("7","5","hgjhghj","01-459893-ppa","hggjh","2020-09-11","2020-09-20","2766-H BAB I (Repaired).docx","ghfh","1");
INSERT INTO tbl_surat_keluar VALUES("9","7","dsdsad","1/2/Undangan-2020-09","dasdasdasd","2020-09-18","2020-09-21","3729-surat masuk2.jpg","Perintah","1");
INSERT INTO tbl_surat_keluar VALUES("10","8","asdas","1/1/Tugas-2020-09","dasdasd
asdasd
dsad","2020-09-11","2020-09-21","6772-surat masuk1.jpg","Perintah","1");



DROP TABLE tbl_surat_masuk;

CREATE TABLE `tbl_surat_masuk` (
  `id_surat` int(10) NOT NULL AUTO_INCREMENT,
  `no_agenda` int(10) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `isi` mediumtext NOT NULL,
  `indeks` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  `jenis_surat` varchar(30) NOT NULL,
  PRIMARY KEY (`id_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO tbl_surat_masuk VALUES("14","1","1/2/Perintah-2020-09","Dinas Pendidikan","Untuk.......","AC2","2020-09-16","2020-09-23","3193-surat masuk.jpg","1","Undangan");
INSERT INTO tbl_surat_masuk VALUES("15","2","2/1/Undangan-1899-11","Dinas Olahraga","Diharapkan untuk ......","AC1","2020-08-19","2020-09-23","19-surat masuk2.jpg","1","Pengantar");



DROP TABLE tbl_user;

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_user VALUES("1","ahmad","61243c7b9a4022cb3f8dc3106767ed12","Ahmad Muyassar Ibrahim","-","1");
INSERT INTO tbl_user VALUES("2","admin","21232f297a57a5a743894a0e4a801fc3","Ahmad Muyassar","448684","2");
INSERT INTO tbl_user VALUES("3","acca123","b14d183b4dd803adec9639f97c0bc252","acca","-","3");



