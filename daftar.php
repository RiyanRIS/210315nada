<!-- The first include should be config.php -->
<?php require_once('config.php') ?>

<?php require_once( ROOT_PATH . '/includes/_head.php') ?>
<link rel="stylesheet" href="assets/signin.css">

	<title> Daftar Akun | WISATAKU.COM </title>
</head>
<body>
    
<?php require_once( ROOT_PATH . '/includes/_nav.php') ?>

<div class="container">
<div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center row">
<form class="form-signin">
  <img class="mb-4" src="https://getbootstrap.com/docs/4.6/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Silahkan Daftar</h1>
  <label for="nama" class="sr-only">Nama</label>
  <input type="text" id="nama" class="form-control" placeholder="Nama Lengkap" required="" autofocus="">
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="">
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
  <label for="inputPassword1" class="sr-only">Ulangi Password</label>
  <input type="password" id="inputPassword1" class="form-control last" placeholder="Konfirmasi Password" required="">
  <button class="btn btn-lg btn-primary btn-block" type="submit">Daftar</button>
  <p class="mt-5 mb-3 text-muted">Sudah punya akun? silahkan <a href="login.php">login</a>.</p>
</form>
</div>
</div>

<?php require_once( ROOT_PATH . '/includes/_foot.php') ?>
    
  </body>
</html>

