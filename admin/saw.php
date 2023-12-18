<?php
class Saw
{
  private $db;
  function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=skripsi', "root", "");
  }

  public function get_data_kriteria(){
    $stmt = $this->db->prepare("SELECT*FROM kriteriasaw ORDER BY id_kriteria");
    $stmt->execute();
    return $stmt;
  }
	public function get_alternatif_umur(){
		$stmt = $this->db->prepare("SELECT umur FROM balita ORDER BY idbalita");
		$stmt->execute();
		return $stmt;
	}

  public function get_data_balita(){
    $stmt = $this->db->prepare("SELECT idbalita, nama_balita, alamat FROM balita ORDER BY idbalita");
    $stmt->execute();
    return $stmt;
  }

  public function get_data_kriteria_id($id){
    $stmt = $this->db->prepare("SELECT*FROM kriteriasaw WHERE id_kriteria='$id' ORDER BY id_kriteria");
    $stmt->execute();
    return $stmt;
  }
 
  public function get_data_nilai_id($id){
    $stmt = $this->db->prepare("SELECT*FROM nilaisaw WHERE id_balita='$id' ORDER BY id_kriteria");
    $stmt->execute();
    return $stmt;
  }

  public function nilai_max($id){
    $stmt = $this->db->prepare("SELECT id_kriteria, MAX(nilai) AS max FROM nilaisaw WHERE id_kriteria='$id' GROUP BY id_kriteria");
    $stmt->execute();
    return $stmt;
  }

  public function nilai_min($id){
    $stmt = $this->db->prepare("SELECT id_kriteria, MIN(nilai) AS min FROM nilai_saw WHERE id_kriteria='$id' GROUP BY id_kriteria");
    $stmt->execute();
    return $stmt;
  }

  public function get_data_balita_awal(){
    $stmt = $this->db->prepare("SELECT perkembangan.*, balita.nama_balita, TIMESTAMPDIFF(MONTH, balita.tanggal_lahir, NOW()) AS usia, imunisasi.status_imunisasi FROM perkembangan LEFT JOIN balita ON balita.idbalita = perkembangan.idbalita
      LEFT JOIN imunisasi ON imunisasi.id_imunisasi = perkembangan.id_imunisasi");
    $stmt->execute();
    return $stmt;
  }

  public function get_data_perkembangan_pembobotan(){
    $stmt = $this->db->prepare("SELECT perkembangan.*, balita.nama_balita, imunisasi.status_imunisasi as noK1, imunisasi.status_berat_badan as noK2, imunisasi.status_tinggi_badan as noK3, imunisasi.status_lingkar_kepala as noK4, imunisasi.status_imunisasi FROM perkembangan LEFT JOIN balita ON balita.idbalita = perkembangan.idbalita
      LEFT JOIN imunisasi ON imunisasi.id_imunisasi = perkembangan.id_imunisasi");
    $stmt->execute();
    return $stmt;
  }

  public function get_data_max(){
    $stmt = $this->db->prepare("SELECT perkembangan.*, balita.nama_balita, max(TIMESTAMPDIFF(MONTH, balita.tanggal_lahir, NOW())) AS maxK1, max(berat_badan) as maxK2, max(tinggi_badan) as maxK3, max(lingkar_kepala) as maxK4, imunisasi.status_imunisasi FROM perkembangan LEFT JOIN balita ON balita.idbalita = perkembangan.idbalita
      LEFT JOIN imunisasi ON imunisasi.id_imunisasi = perkembangan.id_imunisasi");
    $stmt->execute();
    return $stmt;
  }

  public function get_data_min(){
    $stmt = $this->db->prepare("SELECT perkembangan.*, balita.nama_balita, min(TIMESTAMPDIFF(MONTH, balita.tanggal_lahir, NOW())) AS minK1, min(berat_badan) as minK2, min(tinggi_badan) as minK3, min(lingkar_kepala) as minK4, imunisasi.status_imunisasi FROM perkembangan LEFT JOIN balita ON balita.idbalita = perkembangan.idbalita
      LEFT JOIN imunisasi ON imunisasi.id_imunisasi = perkembangan.id_imunisasi");
    $stmt->execute();
    return $stmt;
  }

  public function get_kategorial($kategori, $index){
    if ($index == 1){
      if ($kategori == "Lengkap"){
        $stmt = "3";
      } else if ($kategori == "Kurang Lengkap"){
        $stmt = "2";
      } else {
        $stmt = "1";
      }
    } else if ($index == 4){
      if ($kategori == "Baik"){
        $stmt = "3";
      } else if ($kategori == "Cukup"){
        $stmt = "2";
      } else {
        $stmt = "1";
      }
    } else {
      if ($kategori == "Naik"){
        $stmt = "3";
      } else if ($kategori == "Tetap"){
        $stmt = "2";
      } else {
        $stmt = "1";
      }
    }
    return $stmt;
  }

}

 ?>
