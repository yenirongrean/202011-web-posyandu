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
        <h2>Edit Data Perkembangan Balita</h2>
        <hr>

        <?php
		if(isset($_GET['idperkembangan'])){
			$idperkembangan = $_GET['idperkembangan'];
			
			$select = mysqli_query($koneksi, "SELECT * FROM perkembangan WHERE idperkembangan='$idperkembangan'") or die(mysqli_error($koneksi));

			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();
			}else{
				$data = mysqli_fetch_assoc($select);
			}
		}
		?>

        <?php
		if(isset($_POST['submit'])){
			$idperkembangan	= $_POST['idperkembangan'];
            $idbalita		= $_POST['idbalita'];
            $berat_badan	= $_POST['berat_badan'];
            $tinggi_badan	= $_POST['tinggi_badan'];
            $lingkar_kepala	= $_POST['lingkar_kepala'];
            $id_imunisasi	= $_POST['id_imunisasi'];
			
			$sql = mysqli_query($koneksi, "UPDATE perkembangan SET idperkembangan='$idperkembangan', idbalita='$idbalita', 
                berat_badan='$berat_badan', tinggi_badan='$tinggi_badan', lingkar_kepala='$lingkar_kepala', id_imunisasi='$id_imunisasi' 
                WHERE idperkembangan='$idperkembangan'") or die(mysqli_error($koneksi));
			
			if($sql){
				echo '<script>alert("Berhasil memperbarui data."); document.location="../index-perkembangan.php?idperkembangan='.$idperkembangan.'";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

        <form action="edit-perkembangan.php?idperkembangan=<?php echo $idperkembangan; ?>" method="post"
            autocomplete="off">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID Perkembangan</label>
                <div class="col-sm-10">
                    <input type="text" name="idperkembangan" class="form-control"
                        value="<?php echo $data['idperkembangan']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Balita</label>
                <div class="col-sm-10">
                    <select id="idbalita" class="form-control" name="idbalita">
                        <?php 
							$sql = mysqli_query($koneksi,"SELECT * FROM balita");
							while ($result = mysqli_fetch_array($sql)) {
						?>
                        <option value="<?php echo $result['idbalita'] ?>"><?php echo $result['nama_balita'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Berat Badan</label>
                <div class="col-sm-10">
                    <input type="text" name="berat_badan" class="form-control"
                        value="<?php echo $data['berat_badan']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tinggi Badan</label>
                <div class="col-sm-10">
                    <input type="text" name="tinggi_badan" class="form-control"
                        value="<?php echo $data['tinggi_badan']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Lingkar Kepala</label>
                <div class="col-sm-10">
                    <input type="text" name="lingkar_kepala" class="form-control"
                        value="<?php echo $data['lingkar_kepala']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID Imunisasi</label>
                <div class="col-sm-10">
                    <input type="text" name="id_imunisasi" class="form-control"
                        value="<?php echo $data['id_imunisasi']; ?>" required>
                </div>
            </div>
            <div class="form-group text-right">
                <a href="../index-perkembangan.php" class="btn btn-default">Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>

    </div>
</body>

</html>
