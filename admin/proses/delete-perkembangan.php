<?php

include('../koneksi.php');
 
if(isset($_GET['idperkembangan'])){

	$idperkembangan = $_GET['idperkembangan'];
	
	$cek = mysqli_query($koneksi, "SELECT * FROM perkembangan WHERE idperkembangan='$idperkembangan'") or die(mysqli_error($koneksi));
	
	if(mysqli_num_rows($cek) > 0){
		$del = mysqli_query($koneksi, "DELETE FROM perkembangan WHERE idperkembangan='$idperkembangan'") or die(mysqli_error($koneksi));
		if($del){
			echo '<script>alert("Berhasil menghapus data."); document.location="../index-perkembangan.php";</script>';
		}else{
			echo '<script>alert("Gagal menghapus data."); document.location="../index-perkembangan.php";</script>';
		}
	}else{
		echo '<script>alert("ID tidak ditemukan di database."); document.location="../index-perkembangan.php";</script>';
	}
}else{
	echo '<script>alert("ID tidak ditemukan di database."); document.location="../index-perkembangan.php";</script>';
}
 
?>
