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
        <h2>Edit Data Imunisasi Balita</h2>
        <hr>

        <?php
		if(isset($_GET['id_imunisasi'])){
			$id_imunisasi = $_GET['id_imunisasi'];
			
			$select = mysqli_query($koneksi, "SELECT * FROM imunisasi WHERE id_imunisasi='$id_imunisasi'") or die(mysqli_error($koneksi));

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
			$$id_imunisasi	= $_POST['id_imunisasi'];
			$idbalita		= $_POST['idbalita'];
			$hb             = $_POST['hb'];
			$bcg	        = $_POST['bcg'];
			$dpt1	        = $_POST['dpt1'];
            $hb2	        = $_POST['hb2'];
            $hb3	        = $_POST['hb3'];
            $campak	        = $_POST['campak'];
            $status_imunisasi	= $_POST['status_imunisasi'];
            $status_berat_badan = $_POST['status_berat_badan'];
            $status_tinggi_badan    = $_POST['status_tinggi_badan'];
            $status_lingkar_kepala  = $_POST['status_lingkar_kepala'];
			
			$sql = mysqli_query($koneksi, "UPDATE imunisasi SET id_imunisasi='$id_imunisasi', idbalita='$idbalita', 
                hb='$hb', bcg='$bcg', dpt1='$dpt1', hb2='$hb2', hb3='$hb3', campak='$campak', status_imunisasi='$status_imunisasi', status_berat_badan='$status_berat_badan', status_tinggi_badan='$status_tinggi_badan', status_lingkar_kepala='$status_lingkar_kepala' 
                WHERE id_imunisasi='$id_imunisasi'") or die(mysqli_error($koneksi));
			
			if($sql){
				echo '<script>alert("Berhasil memperbarui data."); document.location="../index-imunisasi.php?id_imunisasi='.$id_imunisasi.'";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>

        <form action="edit-imunisasi.php?id_imunisasi=<?php echo $id_imunisasi; ?>" method="post" autocomplete="off">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID Imunisasi</label>
                <div class="col-sm-10">
                    <input type="text" name="id_imunisasi" class="form-control"
                        value="<?php echo $data['id_imunisasi']; ?>" required>
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
                <label class="col-sm-2 col-form-label">HB</label>
                <div class="col-sm-10">
                    <input type="date" name="hb" class="form-control" value="<?php echo $data['hb']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">BCG</label>
                <div class="col-sm-10">
                    <input type="date" name="bcg" class="form-control" value="<?php echo $data['bcg']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">DPT 1</label>
                <div class="col-sm-10">
                    <input type="date" name="dpt1" class="form-control" value="<?php echo $data['dpt1']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">HB 2</label>
                <div class="col-sm-10">
                    <input type="date" name="hb2" class="form-control" value="<?php echo $data['hb2']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">HB 3</label>
                <div class="col-sm-10">
                    <input type="date" name="hb3" class="form-control" value="<?php echo $data['hb3']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Campak</label>
                <div class="col-sm-10">
                    <input type="date" name="campak" class="form-control" value="<?php echo $data['campak']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Kelengkapan</label>
                <div class="col-sm-10">
                    <select class="form-control" name="status_imunisasi" required>
                        <option value=""> Pilih Status </option>
                        <option value="Lengkap" <?php if($data['status_imunisasi'] == 'Lengkap') { ?> selected="selected" <?php } ?>>Lengkap
                        </option>
                        <option value="Kurang Lengkap" <?php if($data['status_imunisasi'] == 'Kurang Lengkap') { ?> selected="selected" <?php } ?>>Kurang Lengkap
                        </option>
                        <option value="Tidak Ada" <?php if($data['status_imunisasi'] == 'Tidak Ada') { ?> selected="selected" <?php } ?>>Tidak Ada
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Berat Badan</label>
                <div class="col-sm-10">
                    <select class="form-control" name="status_berat_badan" required>
                        <option value=""> Pilih Status </option>
                        <option value="Naik" <?php if($data['status_berat_badan'] == 'Naik') { ?> selected="selected" <?php } ?>>Naik
                        </option>
                        <option value="Tetap" <?php if($data['status_berat_badan'] == 'Tetap') { ?> selected="selected" <?php } ?>>Tetap
                        </option>
                        <option value="Turun" <?php if($data['status_berat_badan'] == 'Turun') { ?> selected="selected" <?php } ?>>Turun
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Tinggi Badan</label>
                <div class="col-sm-10">
                    <select class="form-control" name="status_tinggi_badan" required>
                        <option value=""> Pilih Status </option>
                        <option value="Naik" <?php if($data['status_tinggi_badan'] == 'Naik') { ?> selected="selected" <?php } ?>>Naik
                        </option>
                        <option value="Tetap" <?php if($data['status_tinggi_badan'] == 'Tetap') { ?> selected="selected" <?php } ?>>Tetap
                        </option>
                        <option value="Turun" <?php if($data['status_tinggi_badan'] == 'Turun') { ?> selected="selected" <?php } ?>>Turun
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Lingkar Kepala</label>
                <div class="col-sm-10">
                    <select class="form-control" name="status_lingkar_kepala" required>
                        <option value=""> Pilih Status </option>
                        <option value="Baik" <?php if($data['status_lingkar_kepala'] == 'Baik') { ?> selected="selected" <?php } ?>>Baik
                        </option>
                        <option value="Cukup" <?php if($data['status_lingkar_kepala'] == 'Cukup') { ?> selected="selected" <?php } ?>>Cukup
                        </option>
                        <option value="Kurang Baik" <?php if($data['status_lingkar_kepala'] == 'Kurang Baik') { ?> selected="selected" <?php } ?>>Kurang Baik
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group text-right">
                <a href="../index-imunisasi.php" class="btn btn-default">Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>

    </div>
</body>

</html>
