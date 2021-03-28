<?php require_once('config.php') ?>
<?php require_once('includes/register.php') ?>

<?php require_once( ROOT_PATH . '/includes/_head.php') ?>
<link rel="stylesheet" href="assets/signin.css">

	<title> Daftar Akun |  <?= $namasitus ?> </title>
</head>
<body>
    
<?php require_once( ROOT_PATH . '/includes/_nav.php') ?>

<div class="container">
<div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center row">
<form class="form-signin" method="post" action="daftar.php">
  <img class="mb-4" src="https://getbootstrap.com/docs/4.6/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Silahkan Daftar</h1>
  <?php include(ROOT_PATH . '/includes/errors.php') ?>
  <label for="nama" class="sr-only">Nama</label>
  <input type="text" name="nama" id="nama" value="<?= $nama ?>" class="form-control" placeholder="Nama Lengkap" required="" autofocus="">
  <label for="nama" class="sr-only">Username</label>
  <input type="text" name="username" maxlength="16" id="username" value="<?= $username ?>" class="form-control" placeholder="Username" required="">
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" name="email" value="<?= $email ?>" id="inputEmail" class="form-control" placeholder="Email address" required="">
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" name="password_1" id="inputPassword" class="form-control" placeholder="Password" required="">
  <label for="inputPassword1" class="sr-only">Konfirmasi Password</label>
  <input type="password" name="password_2" id="inputPassword1" class="form-control last" placeholder="Konfirmasi Password" required="">
  <button class="btn btn-lg btn-primary btn-block" name="reg_user" type="submit">Daftar</button>
  <p class="mt-5 mb-3 text-muted">Sudah punya akun? silahkan <a href="login.php">login</a>.</p>
</form>
</div>
</div>

<?php require_once( ROOT_PATH . '/includes/_foot.php') ?>
  </body>
</html>

