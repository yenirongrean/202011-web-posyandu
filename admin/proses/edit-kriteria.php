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
        <h2>Edit Data Kriteria</h2>
        <hr>

        <?php
		if(isset($_GET['id_kriteria'])){
			$id_kriteria = $_GET['id_kriteria'];
			
			$select = mysqli_query($koneksi, "SELECT * FROM kriteriasaw WHERE id_kriteria='$id_kriteria'") or die(mysqli_error($koneksi));

			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();
			}else{
				$data = mysqli_fetch_assoc($select);
			}
		} 

        if(isset($_POST['submit'])){
            $nama_kriteria  = $_POST['nama_kriteria'];
            $jenis  = $_POST['jenis'];
            $bobot  = $_POST['bobot'];
            $nama_parameter     = $_POST['nama_parameter'];
            
            $sql = mysqli_query($koneksi, "UPDATE kriteriasaw SET nama_kriteria='$nama_kriteria', jenis='$jenis', bobot='$bobot', nama_parameter='$nama_parameter' WHERE id_kriteria='$id_kriteria'") or die(mysqli_error($koneksi));
            
            if($sql){
                echo '<script>alert("Berhasil memperbarui data."); document.location="../kriteria.php?id_kriteria='.$id_kriteria.'";</script>';
            }else{
                echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
            }
        }
        ?>

        <form action="edit-kriteria.php?id_kriteria=<?php echo $id_kriteria; ?>" method="post" autocomplete="off">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID Kriteria</label>
                <div class="col-sm-10">
                    <input type="text" name="id_kriteria" class="form-control" value="<?php echo $data['id_kriteria']; ?>"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Kriteria</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_kriteria" class="form-control"
                        value="<?php echo $data['nama_kriteria']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis</label>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="jenis" value="benefit"
                            <?php if($data['jenis'] == 'benefit'){ echo 'checked'; } ?> required>
                        <label class="form-check-label">benefit</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="jenis" value="cost"
                            <?php if($data['jenis'] == 'cost'){ echo 'checked'; } ?> required>
                        <label class="form-check-label">cost</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Bobot</label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" name="bobot" class="form-control" value="<?php echo $data['bobot']; ?>"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Parameter</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_parameter" class="form-control" value="<?php echo $data['nama_parameter']; ?>"
                        required>
                </div>
            </div>
            <div class="form-group text-right">
                <a href="../kriteria.php" class="btn btn-default">Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>

    </div>
</body>

</html>
