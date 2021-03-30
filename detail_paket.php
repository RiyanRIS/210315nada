<?php require_once('config.php') ?>
<?php require_once('includes/paket_function.php') ?>
<?php 
  $id = $_GET['id'];
  
  $paket = getPaketById($id);
  $nama = $paket['nama'];
  $deskripsi = $paket['deskripsi'];
  $kunjungan = $paket['kunjungan'];
  $harga = $paket['harga'];

?>

<?php require_once( ROOT_PATH . '/includes/_head.php') ?>
	<title> Detail Pesanan |  <?= $namasitus ?> </title>
</head>
<body class="bg-light">
    
<?php require_once( ROOT_PATH . '/includes/_nav.php') ?>

<div class="album py-5">
    <div class="container">
      <h2>Detail Paket</h2>
      <?php include(ROOT_PATH . '/includes/errors.php') ?>
      <div class="row">
      <div class="col-sm-12">
          <label>Nama Paket*</label>
          <input type="text" required="" disabled="" name="nama" value="<?= $nama ?>" class="form-control" placeholder="Nama Paket">
        </div>
        <div class="col-sm-12">
          <label>Deskripsi*</label>
          <textarea name="deskripsi" disabled="" class="form-control" id="deskripsi" cols="30" rows="5" placeholder="Deskripsi paket"><?= $deskripsi ?></textarea>
        </div>
        <div class="col-sm-12">
          <label>Kunjungan*</label>
          <input type="text" required="" disabled="" name="kunjungan" value="<?= $kunjungan ?>" class="form-control" placeholder="Kunjungan">
        </div>
        <div class="col-sm-12">
          <label>Harga</label>
          <input type="number" name="harga" disabled="" value="<?= $harga ?>" class="form-control" placeholder="Harga">
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