-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Nov 2023 pada 13.17
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `balita`
--

CREATE TABLE `balita` (
  `idbalita` int(5) NOT NULL,
  `nama_balita` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `balita`
--

INSERT INTO `balita` (`idbalita`, `nama_balita`, `tanggal_lahir`, `jenis_kelamin`, `nama_ayah`, `nama_ibu`, `alamat`) VALUES
(1, 'Dea Anggaraini', '2022-05-12', 'Perempuan', 'UDIN', 'MARE', 'XX'),
(2, 'Musa', '2021-10-11', 'Laki-laki', 'ASE', 'IRE', 'XYZ'),
(3, 'Roberth Sapan', '2022-05-24', 'Laki-laki', 'WERU', 'ASI', 'QWE'),
(4, 'Batto P', '2021-11-12', 'Laki-laki', 'DSA', 'TEE', 'BCVC'),
(5, 'Sri Ningsih', '2021-12-01', 'Perempuan', 'WQA', 'SAW', 'DSA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `imunisasi`
--

CREATE TABLE `imunisasi` (
  `id_imunisasi` int(5) NOT NULL,
  `idbalita` int(5) NOT NULL,
  `hb` date DEFAULT NULL,
  `bcg` date DEFAULT NULL,
  `dpt1` date DEFAULT NULL,
  `hb2` date DEFAULT NULL,
  `hb3` date DEFAULT NULL,
  `campak` date DEFAULT NULL,
  `status_imunisasi` enum('Lengkap','Kurang Lengkap','Tidak Ada') NOT NULL,
  `status_tinggi_badan` enum('Naik','Tetap','Turun') NOT NULL,
  `status_berat_badan` enum('Naik','Tetap','Turun') NOT NULL,
  `status_lingkar_kepala` enum('Baik','Cukup','Kurang Baik') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `imunisasi`
--

INSERT INTO `imunisasi` (`id_imunisasi`, `idbalita`, `hb`, `bcg`, `dpt1`, `hb2`, `hb3`, `campak`, `status_imunisasi`, `status_tinggi_badan`, `status_berat_badan`, `status_lingkar_kepala`) VALUES
(1, 1, '2019-12-12', '2019-12-12', '2019-12-12', '2020-01-12', '2020-01-25', '2020-01-25', 'Kurang Lengkap', 'Tetap', 'Turun', 'Kurang Baik'),
(2, 2, '2019-12-12', '2019-12-12', '2019-12-12', '0020-01-12', '2020-01-25', '2020-01-25', 'Lengkap', 'Naik', 'Naik', 'Baik'),
(3, 3, '2019-12-12', '2019-12-12', '2019-12-12', '2020-01-12', '2020-01-25', '2020-01-25', 'Tidak Ada', 'Turun', 'Turun', 'Kurang Baik'),
(4, 4, '2019-12-12', '2019-12-12', '2019-12-12', '2020-01-12', '2020-01-25', '2020-01-25', 'Tidak Ada', 'Turun', 'Turun', 'Kurang Baik'),
(5, 5, '2019-12-12', '2019-12-12', '2019-12-12', '2020-01-12', '2020-01-25', '2020-01-25', 'Tidak Ada', 'Turun', 'Tetap', 'Kurang Baik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteriasaw`
--

CREATE TABLE `kriteriasaw` (
  `id_kriteria` int(100) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `jenis` enum('cost','benefit') NOT NULL,
  `bobot` double NOT NULL,
  `nama_parameter` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteriasaw`
--

INSERT INTO `kriteriasaw` (`id_kriteria`, `nama_kriteria`, `jenis`, `bobot`, `nama_parameter`) VALUES
(1, 'Umur', 'benefit', 0.3, 'usia'),
(2, 'Berat Badan', 'benefit', 0.25, 'berat_badan'),
(3, 'Tinggi Badan', 'benefit', 0.25, 'tinggi_badan'),
(4, 'Lingkar Kepala', 'benefit', 0.2, 'lingkar_kepala');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `nama`, `username`, `password`, `level`) VALUES
(7, 'Admin', 'admin', 'admin', 'admin'),
(8, 'User', 'user', 'user', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilaisaw`
--

CREATE TABLE `nilaisaw` (
  `id` int(11) NOT NULL,
  `id_nilai` int(110) NOT NULL,
  `id_kriteria` int(110) NOT NULL,
  `id_balita` int(110) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perkembangan`
--

CREATE TABLE `perkembangan` (
  `idperkembangan` int(5) NOT NULL,
  `idbalita` int(5) NOT NULL,
  `berat_badan` double NOT NULL,
  `tinggi_badan` double NOT NULL,
  `lingkar_kepala` double NOT NULL,
  `id_imunisasi` int(5) NOT NULL,
  `lingkar_perut` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perkembangan`
--

INSERT INTO `perkembangan` (`idperkembangan`, `idbalita`, `berat_badan`, `tinggi_badan`, `lingkar_kepala`, `id_imunisasi`, `lingkar_perut`) VALUES
(1, 1, 6, 55, 12, 1, 0),
(2, 2, 15, 68, 15, 2, 0),
(3, 3, 5, 56, 12, 3, 0),
(4, 4, 8, 63, 13, 4, 0),
(5, 5, 9, 60, 13, 5, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `balita`
--
ALTER TABLE `balita`
  ADD PRIMARY KEY (`idbalita`);

--
-- Indeks untuk tabel `imunisasi`
--
ALTER TABLE `imunisasi`
  ADD PRIMARY KEY (`id_imunisasi`),
  ADD KEY `idbalita` (`idbalita`);

--
-- Indeks untuk tabel `kriteriasaw`
--
ALTER TABLE `kriteriasaw`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilaisaw`
--
ALTER TABLE `nilaisaw`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `perkembangan`
--
ALTER TABLE `perkembangan`
  ADD PRIMARY KEY (`idperkembangan`),
  ADD KEY `idbalita` (`idbalita`),
  ADD KEY `id_imunisasi` (`id_imunisasi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `nilaisaw`
--
ALTER TABLE `nilaisaw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10005;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `imunisasi`
--
ALTER TABLE `imunisasi`
  ADD CONSTRAINT `imunisasi_ibfk_1` FOREIGN KEY (`idbalita`) REFERENCES `balita` (`idbalita`),
  ADD CONSTRAINT `imunisasi_ibfk_2` FOREIGN KEY (`idbalita`) REFERENCES `balita` (`idbalita`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
