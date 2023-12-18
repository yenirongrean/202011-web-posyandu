<?php
	include('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Posyandu Dusun, Pangalla</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
						<a class="dropdown-item" href="index-balita.php">Data Umum</a>
						<a class="dropdown-item" href="index-imunisasi.php">Data Imunisasi</a>
						<a class="dropdown-item" href="kriteria.php">Data Kriteria</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index-perkembangan.php">Data Perkembangan</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="laporan-perkembangan.php">Laporan Perkembangan</a>
				</li>
			</ul>
		</div>
	</nav>

	<br><br><br><br><br>

	<div class="container">
		<h2>Data Kriteria</h2>
		<hr>

		<div id="button">
			<span style="float: right">
				<a href="proses/create-kriteria.php" class="btn btn-outline-success" role="button">Tambah Data</a>
			</span>
		</div>
		<table class="table table-striped table-hover table-sm table-bordered">
			<thead class="thead">
				<tr align="center">
					<th>ID Kriteria</th>
					<th>Nama Kriteria</th>
					<th>jenis</th>
					<th>Bobot</th>
					<th>Aksi</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$sql = mysqli_query($koneksi, "SELECT * FROM kriteriasaw")
					or die(mysqli_error($koneksi));

				if(mysqli_num_rows($sql) > 0){
					$no = 1;

					while($data = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td align="center">'.$data['id_kriteria'].'</td>
							<td>'.$data['nama_kriteria'].'</td>
							<td>'.$data['jenis'].'</td>
							<td>'.$data['bobot'].'</td>
							<td>
								<a href="proses/edit-kriteria.php?id_kriteria='.$data['id_kriteria'].'"><span class="badge badge-warning">Edit</a>
								<a href="proses/delete-kriteria.php?id_kriteria='.$data['id_kriteria'].'" class="badge badge-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
					$no++;
					}
				}else{
					echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
				}
			?>
			<tbody>
		</table>
	</div>
   <br>
   <br>
   <br>
   <br>
   <br>
	<?php
		include('template/footer.php');
	?>
</body>

</html>
