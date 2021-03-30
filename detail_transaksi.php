<?php require_once('config.php') ?>
<?php require_once('includes/users_function.php') ?>
<?php require_once('includes/paket_function.php') ?>
<?php require_once('includes/transaksi_function.php') ?>
<?php 
  $id = $_GET['id'];
  
  $transaksi = getTransaksiById($id);
  $tbb = date("d F Y H:i:s", $transaksi['tanggal_berangkat']);
  $jumlah_orang = $transaksi['jumlah_orang'];
  $ket = $transaksi['ket'];

  $paket = getPaketById($transaksi['paket']);
  $nama_paket = $paket['nama'];
  $deskripsi = $paket['deskripsi'];
  $kunjungan = $paket['kunjungan'];
  $harga = $paket['harga'];

  $paket = getUsersById($transaksi['user']);
  $nama = $paket['nama'];
  $email = $paket['email'];
?>

<?php require_once( ROOT_PATH . '/includes/_head.php') ?>
	<title> Detail Pesanan |  <?= $namasitus ?> </title>
</head>
<body class="bg-light">
    
<?php require_once( ROOT_PATH . '/includes/_nav.php') ?>

<div class="album py-5">
    <div class="container">
      <h2>Detail Pesanan</h2>
      <?php include(ROOT_PATH . '/includes/errors.php') ?>
      <div class="row">
        <div class="col-sm-6">
          <label for="firstName" class="form-label">Nama Pemesan</label>
          <input type="text" class="form-control" id="firstName" name="nama" value="<?= $nama ?>" required="" disabled="" placeholder="Nama Pemesan">
        </div>
        <div class="col-sm-6">
          <label for="email" class="form-label">Email Pemesan</label>
          <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required="" disabled="" placeholder="Email Pemesan">
        </div>
        <div class="col-sm-12"><hr></div>
        <div class="col-sm-6">
          <label for="paket" class="form-label">Nama Paket</label>
          <input type="text" class="form-control" id="paket" name="paket" value="<?= $nama_paket ?>" required="" disabled="" placeholder="Nama Paket">
        </div>
        <div class="col-sm-6">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $deskripsi ?>" required="" disabled="" placeholder="Deskripsi">
        </div>
        <div class="col-sm-6">
          <label for="kunjungan" class="form-label">Kunjungan</label>
          <input type="text" class="form-control" id="kunjungan" name="kunjungan" value="<?= $kunjungan ?>" required="" disabled="" placeholder="Kunjungan">
        </div>
        <div class="col-sm-6">
          <label for="harga" class="form-label">Harga</label>
          <input type="text" class="form-control" id="harga" name="harga" value="<?= toRp($harga) ?>" required="" disabled="" placeholder="Harga">
        </div>
        <div class="col-sm-12"><hr></div>
        <div class="col-sm-6">
          <label for="tbb" class="form-label">Tanggal Berangkat</label>
          <input type="text" class="form-control" id="tbb" name="tbb" value="<?= $tbb ?>" required="" disabled="" placeholder="Masukkan Tanggal Keberangkatan">
        </div>
        <div class="col-sm-6">
          <label for="jumlah" class="form-label">Jumlah Orang</label>
          <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $jumlah_orang ?>" disabled="" required="" placeholder="Masukkan jumlah orang yang ikut">
        </div>
        <div class="col-sm-6">
          <label for="ctt" class="form-label">Catatan</label>
          <textarea name="ctt" disabled="" class="form-control" id="ctt" cols="30" rows="5"><?= $ket ?></textarea>
        </div>
        <div class="col-sm-12"><hr></div>
        <div class="col-sm-12">
          <br>
          <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
      </div>
    </div>
  </div>

  <?php require_once( ROOT_PATH . '/includes/_foot.php') ?>

  </body>
</html>