<?php require_once('config.php') ?>
<?php require_once('includes/users_function.php') ?>
<?php
$user = getUsersById($_SESSION['user']['id']);
$nama = $user['nama'];
$username = $user['username'];
$email = $user['email'];
$role = $user['role'];
if($user['status'] == 1){
  $status = "Active";
}else{
  $status = "Deactive";
}
$last = date("d F Y H:i:s",$user['last_login']);
$create = date("d F Y H:i:s",$user['create_at']);
?>

<?php require_once( ROOT_PATH . '/includes/_head.php') ?>
	<title> Profil Pengguna |  <?= $namasitus ?> </title>
</head>
<body class="bg-light">
    
<?php require_once( ROOT_PATH . '/includes/_nav.php') ?>

<div class="album py-5">
    <div class="container">
      <h2>Profil Pengguna</h2>
      <?php include(ROOT_PATH . '/includes/errors.php') ?>
      <form action="<?= BASE_URL ?>profil.php" method="post">
      <div class="row">
        <div class="col-sm-6">
          <label>Nama Lengkap*</label>
          <input type="text" required="" name="nama" value="<?= $nama ?>" class="form-control" placeholder="Nama Lengkap">
        </div>
        <div class="col-sm-6">
          <label>Username*</label>
          <input type="text" required="" name="username" value="<?= $username ?>" class="form-control" placeholder="Username">
        </div>
        <div class="col-sm-6">
          <label>Email*</label>
          <input type="text" required="" name="email" value="<?= $email ?>" class="form-control" placeholder="Email">
        </div>
        <div class="col-sm-6">
          <label>Role*</label>
          <input type="text" disabled="" name="role" value="<?= ucwords($role) ?>" class="form-control" placeholder="Role">
        </div>
        <div class="col-sm-6">
          <label>Status*</label>
          <input type="text" disabled="" name="rolse" value="<?= $status ?>" class="form-control" placeholder="Role">
        </div>
        
        <div class="col-sm-12 small"><br> Last Login at: <strong> <?= $last ?></strong></div>
        <div class="col-sm-12 small">Create at: <strong><?= $create ?></strong></div>
        <div class="col-sm-12"><hr></div>
        <div class="col-sm-12">
          <br>
          <button type="submit" class="btn btn-primary" name="updateuser"><i class="fa fa-save"></i> Simpan</button>
          <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
        </div>
      </div>
      </form>

    </div>
  </div>

  <?php require_once( ROOT_PATH . '/includes/_foot.php') ?>

  </body>
</html>