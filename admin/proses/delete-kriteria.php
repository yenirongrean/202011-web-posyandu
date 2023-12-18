<?php

include('../koneksi.php');
 
if(isset($_GET['id_kriteria'])){

	$id_kriteria = $_GET['id_kriteria'];
	
	$cek = mysqli_query($koneksi, "SELECT * FROM kriteriasaw WHERE id_kriteria='$id_kriteria'") or die(mysqli_error($koneksi));
	
	if(mysqli_num_rows($cek) > 0){
		$del = mysqli_query($koneksi, "DELETE FROM kriteriasaw WHERE id_kriteria='$id_kriteria'") or die(mysqli_error($koneksi));
		if($del){
			echo '<script>alert("Berhasil menghapus data."); document.location="../kriteria.php";</script>';
		}else{
			echo '<script>alert("Gagal menghapus data."); document.location="../kriteria.php";</script>';
		}
	}else{
		echo '<script>alert("ID tidak ditemukan di database."); document.location="../kriteria.php";</script>';
	}
}else{
	echo '<script>alert("ID tidak ditemukan di database."); document.location="../kriteria.php";</script>';
}
 
?>
