<?php
	include('../koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Posyandu Dusun, Pangalla</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .navbar-nav .nav-item:not(:last-child) {
            border-right: 1px solid silver;
        }

        @media (max-width: 768px) {
            .navbar-nav .nav-item:not(:last-child) {
                border-right: none;
            }
        }

        .navbar-brand {
            font-family: 'Roboto', sans-serif;
            font-size: 25px;
            margin: 0px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
        <a class="navbar-brand">
            <img src="http://indihealth.com/indihealthcom/assets/images/products/5acf891ba61c4.png" alt="Logo"
                style="width:150px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Data Balita
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../index-balita.php">Data Umum</a>
                        <a class="dropdown-item" href="../index-imunisasi.php">Data Imunisasi</a>
                        <a class="dropdown-item" href="../kriteria.php">Data Kriteria</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index-perkembangan.php">Data Perkembangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../laporan-perkembangan.php">Laporan Perkembangan</a>
                </li>
            </ul>
        </div>
    </nav>

    <br>

    <div class="container">
        <h2>Tambah Data Balita</h2>
        <hr>

        <?php
		if(isset($_POST['submit'])){
			$idbalita		= $_POST['idbalita'];
            $nama_balita	= $_POST['nama_balita'];
            $tanggal_lahir	= $_POST['tanggal_lahir'];
            $jenis_kelamin	= $_POST['jenis_kelamin'];
            $nama_ayah		= $_POST['nama_ayah'];
            $nama_ibu		= $_POST['nama_ibu'];
            $alamat		    = $_POST['alamat'];

			$cek = mysqli_query($koneksi, "SELECT * FROM balita WHERE idbalita='$idbalita'") or die(mysqli_error($koneksi));

			if(mysqli_num_rows($cek) == 0){
                $sql = mysqli_query($koneksi, "INSERT INTO balita(idbalita, nama_balita, tanggal_lahir, jenis_kelamin, nama_ayah, nama_ibu, alamat)
                VALUES('$idbalita', '$nama_balita', '$tanggal_lahir', '$jenis_kelamin', '$nama_ayah', '$nama_ibu', '$alamat')") or die(mysqli_error($koneksi));
				if($sql){
					echo '<script>alert("Berhasil menambahkan data."); document.location="../index-balita.php";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
				}else{
				echo '<div class="alert alert-warning">Gagal, Nomor ID sudah terdaftar.</div>';
				}
			}
		?>

        <form action="create-balita.php" method="post" autocomplete="off">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID Balita</label>
                <div class="col-sm-10">
                    <input type="text" name="idbalita" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama balita</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_balita" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="Laki-laki" required>
                        <label class="form-check-label">Laki-Laki</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="Perempuan" required>
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Ayah</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_ayah" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Ibu</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_ibu" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" name="alamat" class="form-control" required>
                </div>
            </div>
            <div class="form-group text-right">
                <a href="../index-balita.php" class="btn btn-default">Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</body>

</html>

<html>
