<?php

include('../koneksi.php');
 
if(isset($_GET['idbalita'])){

	$idbalita = $_GET['idbalita'];
	
	$cek = mysqli_query($koneksi, "SELECT * FROM balita WHERE idbalita='$idbalita'") or die(mysqli_error($koneksi));
	
	if(mysqli_num_rows($cek) > 0){
		$del = mysqli_query($koneksi, "DELETE FROM balita WHERE idbalita='$idbalita'") or die(mysqli_error($koneksi));
		if($del){
			echo '<script>alert("Berhasil menghapus data."); document.location="../index-balita.php";</script>';
		}else{
			echo '<script>alert("Gagal menghapus data."); document.location="../index-balita.php";</script>';
		}
	}else{
		echo '<script>alert("ID tidak ditemukan di database."); document.location="../index-balita.php";</script>';
	}
}else{
	echo '<script>alert("ID tidak ditemukan di database."); document.location="../index-balita.php";</script>';
}
 
?>
