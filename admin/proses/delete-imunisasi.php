<?php

include('../koneksi.php');
 
if(isset($_GET['id_imunisasi'])){

	$id_imunisasi = $_GET['id_imunisasi'];
	
	$cek = mysqli_query($koneksi, "SELECT * FROM imunisasi WHERE id_imunisasi='$id_imunisasi'") or die(mysqli_error($koneksi));
	
	if(mysqli_num_rows($cek) > 0){
		$del = mysqli_query($koneksi, "DELETE FROM imunisasi WHERE id_imunisasi='$id_imunisasi'") or die(mysqli_error($koneksi));
		if($del){
			echo '<script>alert("Berhasil menghapus data."); document.location="../index-imunisasi.php";</script>';
		}else{
			echo '<script>alert("Gagal menghapus data."); document.location="../index-imunisasi.php";</script>';
		}
	}else{
		echo '<script>alert("ID tidak ditemukan di database."); document.location="../index-imunisasi.php";</script>';
	}
}else{
	echo '<script>alert("ID tidak ditemukan di database."); document.location="../index-imunisasi.php";</script>';
}
 
?>
