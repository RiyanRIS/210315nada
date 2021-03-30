<?php require_once('config.php') ?>
<?php require_once('includes/users_function.php') ?>

<?php require_once( ROOT_PATH . '/includes/_head.php') ?>
	<title> Change Password |  <?= $namasitus ?> </title>
</head>
<body class="bg-light">
    
<?php require_once( ROOT_PATH . '/includes/_nav.php') ?>

<div class="album py-5">
    <div class="container">
      <h2>Ubah Password</h2>
      <?php include(ROOT_PATH . '/includes/errors.php') ?>
      <form action="<?= BASE_URL ?>password.php" method="post">
        <div class="row">
          <div class="col-sm-12">
            <label>Password Lama*</label>
            <input type="password" required="" name="pw" value="<?= $pw ?>" class="form-control" placeholder="Password Lama">
          </div>
          <div class="col-sm-12">
            <label>Password Baru*</label>
            <input type="password" required="" name="pw1" value="<?= $pw1 ?>" class="form-control" placeholder="Password Baru">
          </div>
          <div class="col-sm-12">
            <label>Konfirmasi Password Baru*</label>
            <input type="password" required="" name="pw2" value="<?= $pw2 ?>" class="form-control" placeholder="Konfirmasi Password Baru">
          </div>
          <div class="col-sm-12"><hr></div>
          <div class="col-sm-12">
            <br>
            <button type="submit" class="btn btn-primary" name="resetpw"><i class="fa fa-save"></i> Simpan</button>
            <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php require_once( ROOT_PATH . '/includes/_foot.php') ?>

  </body>
</html>