<!DOCTYPE html>
<html>

<head>
	<title>Pemantauan Perkembangan Balita Posyandu Pangalla</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

	<h2 align="center">Pemantauan Perkembangan Balita<br> Posyandu Pangalla<br /></h2>

	<div class="container">
		<form action="cek_login.php" method="post">
			<div class="row justify-content-center mt-5">
				<div class="col-md-4">
					<div class="card">

						<?php if(isset($_GET["pesan"])) {?>
						<?php if($_GET['pesan']=="gagal"){?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
									aria-hidden="true">×</span></button>
							Proses login gagal. Username dan Password tidak valid.
						</div>
						<?php } ?>
						<?php } ?>

						<div class="card-header bg-transparent mb-0"> <img src="img/posyandu.png"
								style="width:310px;height:200px;"><br><br>
							<h5 class="text-center"><span class="font-weight-bold text-primary">Silahkan Login</span>
							</h5>
						</div>
						<div class="card-body">
							<div class="form-group">
								<input type="text" name="username" class="form-control" placeholder="Username"
									autocomplete="off">
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control" placeholder="Password"
									autocomplete="off">
							</div>
							<div class="form-group"  align="right">
								<label><a href="register.php">Belum punya akun?</a></label>
							</div>
							<div class="form-group">
								<input type="submit" name="" value="Login" class="btn btn-primary btn-block">
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
</body>

</html>
