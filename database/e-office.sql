-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Okt 2020 pada 11.42
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-office`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_disposisi`
--

CREATE TABLE `tbl_disposisi` (
  `id_disposisi` int(10) NOT NULL,
  `tujuan` mediumtext NOT NULL,
  `isi_disposisi` mediumtext NOT NULL,
  `sifat` varchar(100) NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `id_surat` int(10) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_disposisi`
--

INSERT INTO `tbl_disposisi` (`id_disposisi`, `tujuan`, `isi_disposisi`, `sifat`, `batas_waktu`, `catatan`, `id_surat`, `id_user`) VALUES
(2, 'Rektor', 'hghgjhgghjgh', 'Penting', '2020-09-09', 'gfghfh', 6, 1),
(4, 'Kemenag', 'assdasddas\r\nasdasdas\r\nsdasdas\r\nasdasdas\r\nsdasd', 'Biasa', '2020-09-03', 'dasdas', 8, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_instansi`
--

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
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_instansi`
--

INSERT INTO `tbl_instansi` (`id_instansi`, `institusi`, `nama`, `status`, `alamat`, `pimpinan`, `nip`, `website`, `email`, `logo`, `id_user`) VALUES
(1, 'Kementerian Pendidikan dan Kebudayaan', 'Universitas Negeri Makassar Fakultas Bahasa dan Sastra', 'Terakreditasi A', 'Pettarani', 'Ahmad Muyassar Ibrahim', '60200114065', 'https://unm.com', 'amuyassar@gmail.com', 'Logo-Besar.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis`
--

CREATE TABLE `tbl_jenis` (
  `id_jenis` int(5) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jenis`
--

INSERT INTO `tbl_jenis` (`id_jenis`, `kode`, `nama`, `uraian`, `id_user`) VALUES
(12, 'A1', 'Perintah', 'Surat Perintah ......', 1),
(13, 'A2', 'Pengantar', 'Surat Pengantar ......', 1),
(14, 'A3', 'Undangan', 'Surat Undangan ......', 1),
(15, 'A4', 'Tugas', 'Surat Tugas ......', 1),
(16, 'A5', 'Izin', 'Surat Izin', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nomor_surat`
--

CREATE TABLE `tbl_nomor_surat` (
  `no_surat` varchar(30) NOT NULL,
  `jenis_surat` varchar(30) NOT NULL,
  `klasifikasi` varchar(30) NOT NULL,
  `klasifikasi1` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `id_ns` int(5) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_nomor_surat`
--

INSERT INTO `tbl_nomor_surat` (`no_surat`, `jenis_surat`, `klasifikasi`, `klasifikasi1`, `tgl_surat`, `id_ns`, `id_user`) VALUES
('dasdasd', 'Tugas', 'dasdas', 'dsadas', '2020-09-10', 1, 1),
('123dttr', 'Pengantar', 'kjkjdkasd ', 'asdasdasd', '2020-09-10', 2, 1),
('33dd4', 'Perintah', 'sasd', 'dsadasd', '2020-09-07', 3, 1),
('3/2/Tugas-2020-09', 'Tugas', '3', '2', '2020-09-11', 9, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sett`
--

CREATE TABLE `tbl_sett` (
  `id_sett` tinyint(1) NOT NULL,
  `surat_masuk` tinyint(2) NOT NULL,
  `surat_keluar` tinyint(2) NOT NULL,
  `referensi` tinyint(2) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  `no_surat` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sett`
--

INSERT INTO `tbl_sett` (`id_sett`, `surat_masuk`, `surat_keluar`, `referensi`, `id_user`, `no_surat`) VALUES
(1, 10, 10, 10, 1, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_keluar`
--

CREATE TABLE `tbl_surat_keluar` (
  `id_surat` int(10) NOT NULL,
  `no_agenda` int(10) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `isi` mediumtext NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_catat` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `jenis_surat` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_surat_keluar`
--

INSERT INTO `tbl_surat_keluar` (`id_surat`, `no_agenda`, `tujuan`, `no_surat`, `isi`, `tgl_surat`, `tgl_catat`, `file`, `jenis_surat`, `id_user`) VALUES
(2, 1, 'fakultas syariah', '323d234', 'dfsdfs', '2020-09-01', '2020-09-01', '5454-8617-DH RASET WSD 86 JULI  2020.doc', 'dasdasd', 1),
(3, 2, 'dasda', 'asdasd', 'asdasdasd\r\ndasdas\r\nasdasd', '2020-09-08', '2020-09-08', '162-Group 16755.png', 'asdasd', 1),
(4, 3, 'fd', 'sdfsdf', 'fsdfsdf', '2020-09-07', '2020-09-08', '2092-Group 16780.png', 'Tugas', 1),
(11, 4, 'Pemda', '01-459893-ppa', 'ddsadsa\r\nsdasd\r\nasdas', '2020-09-12', '2020-09-24', '7648-surat masuk1.jpg', 'Tugas', 1),
(12, 5, 'Rektor', '3/2/Tugas-2020-09', 'A', '2020-09-11', '2020-09-25', '3064-surat masuk.jpg', 'Tugas', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_masuk`
--

CREATE TABLE `tbl_surat_masuk` (
  `id_surat` int(10) NOT NULL,
  `no_agenda` int(10) NOT NULL,
  `no_suratm` varchar(50) NOT NULL,
  `asal_surat` varchar(250) NOT NULL,
  `isi` mediumtext NOT NULL,
  `indeks` varchar(30) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `file` varchar(250) NOT NULL,
  `id_user` tinyint(2) NOT NULL,
  `jenis_surat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_surat_masuk`
--

INSERT INTO `tbl_surat_masuk` (`id_surat`, `no_agenda`, `no_suratm`, `asal_surat`, `isi`, `indeks`, `tgl_surat`, `tgl_diterima`, `file`, `id_user`, `jenis_surat`) VALUES
(14, 1, '1/2/Perintah-2020-09', 'Dinas Pendidikan', 'Untuk.......', 'AC2', '2020-09-16', '2020-09-23', '3193-surat masuk.jpg', 1, 'Undangan'),
(15, 2, '2/1/Undangan-1899-11', 'Dinas Olahraga', 'Diharapkan untuk ......', 'AC1', '2020-08-19', '2020-09-23', '19-surat masuk2.jpg', 1, 'Tugas'),
(18, 3, '1/2/Perintah-2020-08', 'Pemda', 'Aku', '4A', '2020-09-24', '2020-09-24', '9602-surat masuk.jpg', 1, 'Pengantar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama`, `nip`, `admin`) VALUES
(1, 'ahmad', '61243c7b9a4022cb3f8dc3106767ed12', 'Ahmad Muyassar Ibrahim', '-', 1),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Ahmad Muyassar', '448684', 2),
(4, 'acca17', '5aa5ccfb08a3fe0e9999f1f14327b9b5', 'ahmad', '12345678', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  ADD PRIMARY KEY (`id_disposisi`);

--
-- Indeks untuk tabel `tbl_instansi`
--
ALTER TABLE `tbl_instansi`
  ADD PRIMARY KEY (`id_instansi`);

--
-- Indeks untuk tabel `tbl_jenis`
--
ALTER TABLE `tbl_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `tbl_nomor_surat`
--
ALTER TABLE `tbl_nomor_surat`
  ADD PRIMARY KEY (`id_ns`);

--
-- Indeks untuk tabel `tbl_sett`
--
ALTER TABLE `tbl_sett`
  ADD PRIMARY KEY (`id_sett`);

--
-- Indeks untuk tabel `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  MODIFY `id_disposisi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis`
--
ALTER TABLE `tbl_jenis`
  MODIFY `id_jenis` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tbl_nomor_surat`
--
ALTER TABLE `tbl_nomor_surat`
  MODIFY `id_ns` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
  MODIFY `id_surat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  MODIFY `id_surat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
