<?php require_once('config.php') ?>
<?php require_once('includes/users_function.php') ?>
<?php require_once('includes/paket_function.php') ?>
<?php require_once('includes/pesan_function.php') ?>
<?php 
  $paket = getAllPaket();
?>

<?php require_once( ROOT_PATH . '/includes/_head.php') ?>
	<title> Halaman Pemesanan |  <?= $namasitus ?> </title>
</head>
<body class="bg-light">
    
<?php require_once( ROOT_PATH . '/includes/_nav.php') ?>

<div class="album py-5">
    <div class="container">
      <h2>Checkout Form</h2>
      <?php include(ROOT_PATH . '/includes/errors.php') ?>
      <form action="pesan.php?psnpaket=<?= $_GET['psnpaket'] ?>&psnusers=<?= $_GET['psnusers'] ?>" method="post">
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
            <input type="datetime-local" class="form-control" id="tbb" name="tbb" value="<?= $tbb ?>" required="" placeholder="Masukkan Tanggal Keberangkatan">
          </div>
          <div class="col-sm-6">
            <label for="jumlah" class="form-label">Jumlah Orang</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $jumlah_orang ?>" required="" placeholder="Masukkan jumlah orang yang ikut">
          </div>
          <div class="col-sm-6">
            <label for="ctt" class="form-label">Catatan</label>
            <textarea name="ctt" class="form-control" placeholder="Isi catatan kunjungan" id="ctt" cols="30" rows="5"><?= $ket ?></textarea>
          </div>
          <div class="col-sm-12"><hr></div>
          <div class="col-sm-12">
            <br>
            <button type="submit" class="btn btn-primary" name="create"><i class="fa fa-save"></i> Pesan</button>
            <a href="paket-wisata.php" class="btn btn-danger">Kembali</a>
          </div>

      </form>
    </div>
  </div>

  <?php require_once( ROOT_PATH . '/includes/_foot.php') ?>

  </body>
</html>