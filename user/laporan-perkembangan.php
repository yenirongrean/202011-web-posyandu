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
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand">
      <img src="http://indihealth.com/indihealthcom/assets/images/products/5acf891ba61c4.png" alt="Logo"
        style="width:150px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link disabled" href="" tabindex="-1" aria-disabled="true">Data Balita</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="" tabindex="-1" aria-disabled="true">Data Perkembangan</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="laporan-perkembangan.php">Laporan Perkembangan</a>
        </li>
      </ul>
    </div>
  </nav>

  <br>

  <?php
    spl_autoload_register(function($class){
      require_once $class.'.php';
    });
    $saw = new saw();
  ?>

  <div class="container">
    <h2>Kriteria</h2>
    <table class="table table-striped table-hover table-sm table-bordered">
      <thead class="thead-dark">
        <tr align="center">
          <th>No</th>
          <th>Nama Kriteria</th>
          <th>Jenis</th>
          <th>Bobot</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $kriteria = $saw->get_data_kriteria();
          $jml_kriteria = $kriteria->rowCount();
          while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
          <td align="center">K<?php echo $data_kriteria['id_kriteria']; ?></td>
          <td><?php echo $data_kriteria['nama_kriteria']; ?></td>
          <td><?php echo $data_kriteria['jenis']; ?></td>
          <td align="center"><?php echo $data_kriteria['bobot']; ?></td>
        </tr>
        <?php } ?>
      <tbody>
    </table>

    <hr>
    <br><br>

    <h2>Alternatif/Data Balita</h2>
    <table class="table table-striped table-hover table-sm table-bordered">
      <thead class="thead-dark">
        <tr align="center">
          <th>No</th>
          <th>Nama Balita</th>
          <th>Alamat</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $balita = $saw->get_data_balita();
          while ($data_balita = $balita->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
          <td align="center">A<?php echo $data_balita['idbalita']; ?></td>
          <td><?php echo $data_balita['nama_balita']; ?></td>
          <td><?php echo $data_balita['alamat']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <hr>
    <br><br>

    <h2>Data Balita Awal</h2>
    <table class="table table-striped table-hover table-sm table-bordered">
      <thead class="thead-dark">
        <tr align="center">
          <th rowspan="2">Balita</th>
          <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
        <tr>

          <?php
            $kriteria = $saw->get_data_kriteria();
            while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <th>K<?php echo $data_kriteria['id_kriteria']; ?></th>
          <?php } ?>
        </tr>

        <?php
          $balita = $saw->get_data_balita();
          while ($data_balita = $balita->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
          <td>
            <center>A<?php echo $data_balita['idbalita']; ?></center>
          </td>
          <?php
            $nilai = $saw->get_data_nilai_id($data_balita['idbalita']);
            while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <td>
            <center><?php echo $data_nilai['nilai']; ?></center>
          </td>
          <?php } ?>
        </tr>
        <?php } ?>
    </table>

    <hr>
    <br><br>

    <h2>Normalisasi</h2>
    <table class="table table-striped table-hover table-sm table-bordered">
      <thead class="thead-dark">
        <tr align="center">
          <th rowspan="2">Balita</th>
          <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
        </tr>

        </tr>

        <tr>
          <?php
            $hasil_ranks=array();
            $kriteria = $saw->get_data_kriteria();
            while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <th>K<?php echo $data_kriteria['id_kriteria']; ?></th>
          <?php } ?>
        </tr>

        <?php
        $balita = $saw->get_data_balita();
        while ($data_balita = $balita->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
          <td>
            <center>A<?php echo $data_balita['idbalita']; ?></center>
          </td>

          <?php
          $hasil_normalisasi=0;
          $nilai = $saw->get_data_nilai_id($data_balita['idbalita']);
          while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
            $kriteria = $saw->get_data_kriteria_id($data_nilai['id_kriteria']);
            while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
              if ($data_kriteria['jenis']=="cost") {
                $min = $saw->nilai_min($data_nilai['id_kriteria']);
                while ($data_min = $min->fetch(PDO::FETCH_ASSOC)) { ?>
          <td>
            <center>
              <?php
                      echo number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                          $hasil_kali = $hasil*$data_kriteria['bobot'];
                          $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
                      ?>
            </center>
          </td>
          <?php } ?>

          <?php }elseif ($data_kriteria['jenis']=="benefit") {
                $max = $saw->nilai_max($data_nilai['id_kriteria']);
                while ($data_max = $max->fetch(PDO::FETCH_ASSOC)) { ?>
          <td>
            <center>
              <?php
                      echo $hasil = round($data_nilai['nilai']/$data_max['max'], 3) ;
                        $hasil_kali = $hasil*$data_kriteria['bobot'];
                        $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
                      ?>
            </center>
          </td>
          <?php } ?>

          <?php }
            ?>

          <?php } } ?>

        </tr>
        <?php } ?>

    </table>

    <hr>
    <br><br>

    <h2>Pembobotan</h2>
    <table class="table table-striped table-hover table-sm table-bordered">
      <thead class="thead-dark">
        <tr align="center">
          <th rowspan="2">Balita</th>
          <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
          <th rowspan="2">Hasil</th>
        </tr>

        </tr>

        <tr>
          <?php
          $kriteria = $saw->get_data_kriteria();
          while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <th>K<?php echo $data_kriteria['id_kriteria']; ?></th>
          <?php } ?>
        </tr>

        <?php
          $hasil_ranks=array();
          $balita = $saw->get_data_balita();
          while ($data_balita = $balita->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
          <td>
            <center>A<?php echo $data_balita['idbalita']; ?></center>
          </td>
          <?php

      $hasil_normalisasi=0;
      $nilai = $saw->get_data_nilai_id($data_balita['idbalita']);
      while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {

        $kriteria = $saw->get_data_kriteria_id($data_nilai['id_kriteria']);
        while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
          if ($data_kriteria['jenis']=="cost") {
            $min = $saw->nilai_min($data_nilai['id_kriteria']);
            while ($data_min = $min->fetch(PDO::FETCH_ASSOC)) { ?>
          <td>
            <center>
              <?php
                      number_format($hasil = $data_min['min']/$data_nilai['nilai'],2);
                      echo  $hasil_kali = $hasil*$data_kriteria['bobot'];
                      $hasil_normalisasi=$hasil_normalisasi+$hasil_kali;
                   ?>
            </center>
          </td>
          <?php } ?>

          <?php }elseif ($data_kriteria['jenis']=="benefit") {
            $max = $saw->nilai_max($data_nilai['id_kriteria']);
            while ($data_max = $max->fetch(PDO::FETCH_ASSOC)) { ?>
          <td>
            <center>
              <?php
                    $hasil = $data_nilai['nilai']/$data_max['max'];
                    echo $hasil_kali = round($hasil*$data_kriteria['bobot'], 3) ;
                    $hasil_normalisasi = $hasil_normalisasi+$hasil_kali;
                  ?>
            </center>
          </td>
          <?php } ?>

          <?php }
        ?>

          <?php } } ?>

          <td>
            <center>

              <?php
              $hasil_rank['nilai'] = $hasil_normalisasi;
              $hasil_rank['balita'] = $data_balita['nama_balita'];
              array_push($hasil_ranks,$hasil_rank);
              echo $hasil_normalisasi ; ?>
              </<center>
          </td>
        </tr>
        <?php } ?>

    </table>

    <hr>
    <br><br>

    <h2>Perankingan</h2>
    <table class="table table-striped table-hover table-sm table-bordered">
      <thead class="thead-dark">
        <tr align="center">
          <th>Ranking</th>
          <th>Nama Balita</th>
          <th>Nilai Akhir</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $no=1;
        rsort($hasil_ranks);
        foreach ($hasil_ranks as $rank) { ?>
        <tr>
          <td>
            <center><?php echo $no++ ?></center>
          </td>
          <td>
            <?php echo $rank['balita']; ?>
          </td>
          <td>
            <center><?php echo round($rank['nilai'], 3) ; ?></center>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <?php
		  include('template/footer.php');
	  ?>
</body>

</html>