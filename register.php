<?php
	include('koneksi.php');
?>

<!DOCTYPE html>
<HTML lang="en">

<head>
	<title>Posyandu Pangalla-202011</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Nunito';
		}
	</style>
</head>

<body>
	<div class="container">
		<h2>Registrasi Akun</h2>
		<h4>Isi data dibawah untuk melakukan registrasi akun anda!<h4>

				<hr>

				<?php
if(isset($_POST['submit'])){
	$nama	             = $_POST['nama'];
	$username	         = $_POST['username'];
	$password    		 = $_POST['password'];
	$level				 = $_POST['level'];

	$cek = mysqli_query($koneksi, "SELECT * FROM login WHERE id='$id'") or die(mysqli_error($koneksi));

	if(mysqli_num_rows($cek) == 0){
	$sql = mysqli_query($koneksi, "INSERT INTO login(nama, username, password, level)
		VALUES('$nama', '$username', '$password', '$level')") or die(mysqli_error($koneksi));
		if($sql){
			echo '<script>alert("Berhasil membuat akun."); document.location="index.php";</script>';
		}else{
			echo '<div class="alert alert-warning">Gagal membuat akun.</div>';
		}
		}else{
		echo '<div class="alert alert-warning">Gagal, Nomor ID sudah terdaftar.</div>';
		}
	}
	?>

				<form action="register.php" method="post">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" name="nama" class="form-control" required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Username</label>
						<div class="col-sm-10">
							<input type="text" name="username" class="form-control" placeholder="Username untuk login"
								required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-10">
							<input type="text" name="password" class="form-control" placeholder="Password untuk login"
								required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Level</label>
						<div class="col-sm-10">
							<select class="form-control" name="level">
								<option value=""> Pilih Level </option>
								<option value="admin">Admin</option>
								<option value="user">User</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">&nbsp;</label>
						<div class="col-sm-10">
							<input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
				</form>
	</div>
</body>

</html>