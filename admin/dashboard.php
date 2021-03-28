<?php  include('../config.php'); ?>

<?php require_once( ROOT_PATH . '/admin/includes/_head.php') ?>
	<title> Admin Page | <?= $namasitus ?> </title>
</head>
<body>
    
<?php require_once( ROOT_PATH . '/admin/includes/_nav.php') ?>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Selamat Datang...</h1>
  <p class="lead">Ini adalah website paket wisata daerah, kami menyajikan paket wisata harga bersaing dengan kualitas pelayanan paling yahuudd dijamin puas dan bergaransi.</p>
  <p>Silahkan ke halaman pesan atau daftar jika belum memiliki akun.</p>
    <p>
        <a href="<?= BASE_URL . "paket-wisata.php"  ?>" class="btn btn-primary my-2">Pesan</a>
        <a href="<?= BASE_URL . "daftar.php"  ?>" class="btn btn-secondary my-2">Daftar</a>
    </p>
</div>

<?php require_once( ROOT_PATH . '/admin/includes/_foot.php') ?>
    
  </body>
</html>