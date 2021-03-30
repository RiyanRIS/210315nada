<?php require_once('config.php') ?>
<?php require_once('includes/register.php') ?>

<?php require_once( ROOT_PATH . '/includes/_head.php') ?>
<link rel="stylesheet" href="assets/signin.css">

	<title> Login Akun |  <?= $namasitus ?> </title>
</head>
<body>
    
<?php require_once( ROOT_PATH . '/includes/_nav.php') ?>

<div class="container">
<div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center row">
<form class="form-signin" action="login.php" method="post">
  <img class="mb-4" src="<?= BASE_URL ?>assets/jogja.webp" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Silahkan Login</h1>
  <?php include(ROOT_PATH . '/includes/errors.php') ?>
  <label for="inputEmail" class="sr-only">Username/Email address</label>
  <input type="text" name="username" value="<?= $username ?>" id="inputEmail" class="form-control" placeholder="Username / Email address" required="" autofocus="">
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" name="password" id="inputPassword" class="form-control last" placeholder="Password" required="">
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="login_btn">Masuk</button>
  <p class="mt-5 mb-3 text-muted">Belum punya akun? silahkan <a href="daftar.php">daftar</a>.</p>
</form>
</div>
</div>

<?php require_once( ROOT_PATH . '/includes/_foot.php') ?>
    
  </body>
</html>

