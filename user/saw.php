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

}

 ?>
