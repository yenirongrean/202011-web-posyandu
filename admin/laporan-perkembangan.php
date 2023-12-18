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

  <?php
    spl_autoload_register(function($class){
      require_once $class.'.php';
    });
    $saw = new saw();
  ?>

  <div class="container">
    <h2>Kriteria</h2>
    <table class="table table-striped table-hover table-sm table-bordered">
      <thead class="thead">
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
      <thead class="thead">
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
      <thead class="thead">
        <tr align="center">
          <th rowspan="2">Balita</th>
          <th colspan="<?php echo $jml_kriteria+1; ?>">Kriteria</th>
        <tr>

          <?php
            $kriteria = $saw->get_data_kriteria();
            while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <th>K<?php echo $data_kriteria['id_kriteria']; ?></th>
          <?php } ?>
          <th>Nilai</th>
        </tr>

        <?php
          $balita = $saw->get_data_balita_awal();
          while ($data_balita = $balita->fetch(PDO::FETCH_ASSOC)) {
            $nilai = $data_balita['usia'] + $data_balita['berat_badan'] + $data_balita['tinggi_badan'] + $data_balita['lingkar_kepala'];
        ?>
			</thead>
        <tr>
          <td>
            <center>A<?php echo $data_balita['idbalita']; ?></center>
          </td>
         <td>
            <center><?php echo $data_balita['usia']; ?></center>
          </td>
          <td>
            <center><?php echo $data_balita['berat_badan']; ?></center>
          </td>
          <td>
            <center><?php echo $data_balita['tinggi_badan']; ?></center>
          </td>
          <td>
            <center><?php echo $data_balita['lingkar_kepala']; ?></center>
          </td>
          <td>
            <center><?php echo $nilai; ?></center>
          </td>

          <!-- <?php
            $nilai = $saw->get_data_nilai_id($data_balita['idbalita']);
            while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <td>
            <center><?php echo $data_nilai['nilai']; ?></center>
          </td>
          <?php } ?> -->
        </tr>
        <?php } ?>
    </table>

    <hr>
    <br><br>

    <h2>Normalisasi</h2>
    <table class="table table-striped table-hover table-sm table-bordered">
      <thead class="thead">
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
        $max = $saw->get_data_max()->fetch(PDO::FETCH_ASSOC);
        $min = $saw->get_data_min()->fetch(PDO::FETCH_ASSOC);
        $balita = $saw->get_data_balita_awal();
        while ($data_balita = $balita->fetch(PDO::FETCH_ASSOC)) {
        ?>
				</thead>
        <tr>
          <td>
            <center>A<?php echo $data_balita['idbalita']; ?></center>
          </td>
          <?php
            $kriteria = $saw->get_data_kriteria();
            $noK = 0;
            while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
              $noK++;
              if ($data_kriteria['jenis'] == "benefit"){
                $maxK = "maxK".$noK;
          ?>
            <td>
              <center><?php echo round($data_balita[$data_kriteria['nama_parameter']]/$max[$maxK],2); ?></center>
            </td>
          <?php } else if ($data_kriteria['jenis'] == "cost"){ 
              $minK = "minK".$noK;
            ?>
            <td>
              <center><?php echo round($data_balita[$data_kriteria['nama_parameter']]/$min[$minK],2); ?></center>
            </td>
          <?php }}} ?>
        </tr>
    </table>

    <hr>
    <br><br>

    <h2>Pembobotan</h2>
    <table class="table table-striped table-hover table-sm table-bordered">
      <thead class="thead">
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
        $balita = $saw->get_data_perkembangan_pembobotan();
        while ($data_balita = $balita->fetch(PDO::FETCH_ASSOC)) {
        ?>
				</thead>
        <tr>
          <td>
            <center>A<?php echo $data_balita['idbalita']; ?></center>
          </td>
          <?php
            $kriteria = $saw->get_data_kriteria();
            $no = 0;
            while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
              $no++;
              $noK = "noK$no";
          ?>
            <td>
              <center><?php echo $saw->get_kategorial($data_balita[$noK], $no); ?></center>
            </td>
          <?php }} ?>
        </tr>
    </table>

    <hr>
    <br><br>

    <h2>Perankingan</h2>
    <table class="table table-striped table-hover table-sm table-bordered">
      <thead class="thead">
        <tr align="center">
          <th>Ranking</th>
          <th>Nama Balita</th>
          <th>Nilai Akhir</th>
          <th>SAW</th>
          <th>Keterangan</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $max = $saw->get_data_max()->fetch(PDO::FETCH_ASSOC);
        $min = $saw->get_data_min()->fetch(PDO::FETCH_ASSOC);
        $balita = $saw->get_data_balita_awal();
        $no = 1;
        while ($data_balita = $balita->fetch(PDO::FETCH_ASSOC)) {
            $jumlah= ($data_balita['usia'])+($data_balita['berat_badan'])+($data_balita['tinggi_badan'])+($data_balita['lingkar_kepala']);

            $kriteria = $saw->get_data_kriteria();
            $noK = 0;
            $poin = 0;
            while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
              $noK++;
              if ($data_kriteria['jenis'] == "benefit"){
                $maxK = "maxK".$noK;
                $poin = $poin + (($data_balita[$data_kriteria['nama_parameter']]/$max[$maxK])*$data_kriteria['bobot']);
              } else if ($data_kriteria['jenis' == "cost"]){
                $minK = "minK".$noK;
                $poin = $poin + (($data_balita[$data_kriteria['nama_parameter']]/$min[$minK])*$data_kriteria['bobot']);
              }
            }
            $poin = round($poin, 3);
            /*$poin= round(
             (($data_balita['usia']/$max['maxK1'])*$bobot[0])+
             (($data_balita['berat_badan']/$max['maxK2'])*$bobot[1])+
             (($data_balita['tinggi_badan']/$max['maxK3'])*$bobot[2])+
             (($data_balita['lingkar_kepala']/$max['maxK4'])*$bobot[3]),3);*/

            $data[]=array('nama'=>$data_balita['nama_balita'],
              'jumlah'=>$jumlah,
              'poin'=>$poin);
        }

        foreach ($data as $key => $isi) {
          $nama[$key]=$isi['nama'];
          $jlh[$key]=$isi['jumlah'];
          $poin1[$key]=$isi['poin'];
         }
         array_multisort($poin1,SORT_DESC,$jlh,SORT_DESC,$data);
         $no=1;
         $ket="";

         foreach ($data as $item) {
          $no++;
          if ($no<=10) {
            $ket="Sangat Sehat";
           }else if($no > 10 && $no<= 20){
            $ket="Sehat";
           } else {
            $ket="Kurang Sehat";
           }
        ?>
        <tr>
          <td>
            <center><?php echo $no; ?></center>
          </td>
          <td>
            <center><?php echo $item['nama']; ?></center>
          </td>
          <td>
            <center><?php echo $item['jumlah']; ?></center>
          </td>
          <td>
            <center><?php echo$item['poin']; ?></center>
          </td>
          <td>
            <center><?php echo"$ket" ?></center>
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
