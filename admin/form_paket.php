<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/paket_function.php'); ?>
<?php
  $paket = getAllPaket();
?>

<?php require_once( ROOT_PATH . '/admin/includes/_head.php') ?>
	<title> Users Page | <?= $namasitus ?> </title>
</head>
<body>
    
<?php require_once( ROOT_PATH . '/admin/includes/_nav.php') ?>
<div class="container">
  <div class="card">
    <div class="card-header">
      <?php if ($isEditing === true): ?>
        Ubah data
      <?php else: ?>
        Tambah data
      <?php endif ?>
    </div>

    <div class="card-body small">

        <?php if ($isEditing === true): ?>
          <form action="<?php echo BASE_URL . 'admin/form_paket.php?edit='.$id; ?>" method="post" enctype="multipart/form-data">
        <?php else: ?>
          <form action="<?php echo BASE_URL . 'admin/form_paket.php'; ?>" method="post" enctype="multipart/form-data">
        <?php endif ?>

        <!-- validation errors for the form -->
        <?php include(ROOT_PATH . '/includes/errors.php') ?>

        <!-- if editing user, the id is required to identify that user -->
        <?php if ($isEditing === true): ?>
          <input type="hidden" name="id" value="<?= $id; ?>">
          <input type="hidden" name="rm_gambar" value="<?= $gambar; ?>">
        <?php endif ?>

        <div class="form-group">
          <label>Nama Paket*</label>
          <input type="text" required="" name="nama" value="<?= $nama ?>" class="form-control" placeholder="Nama Paket">
        </div>
        <div class="form-group">
          <label>Deskripsi*</label>
          <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="5" placeholder="Deskripsi paket"><?= $deskripsi ?></textarea>
        </div>
        <div class="form-group">
          <label>Kunjungan*</label>
          <input type="text" required="" name="kunjungan" value="<?= $kunjungan ?>" class="form-control" placeholder="Kunjungan">
        </div>
        <div class="form-group">
          <label>Harga</label>
          <input type="number" name="harga" value="<?= $harga ?>" class="form-control" placeholder="Harga">
        </div>
        <div class="form-group">
          <label>Gambar</label>
          <input type="file" name="gambar" class="form-control">
        </div>

        <!-- if editing user, display the update button instead of create button -->
        <?php if ($isEditing === true): ?>
          <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update</button>
          <a href="paket.php" class="btn btn-warning">Kembali</a>
        <?php else: ?>
          <button type="submit" name="create" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan</button>
          <a href="paket.php" class="btn btn-warning">Kembali</a>
        <?php endif ?>
      </form>
    </div>
  </div>

</div>

<?php require_once( ROOT_PATH . '/admin/includes/_foot.php') ?>
    
  </body>
</html>