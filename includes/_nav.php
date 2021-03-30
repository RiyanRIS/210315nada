<?php if(isAdmin()): ?>
<?php require_once( ROOT_PATH . '/admin/includes/_nav.php') ?>
<?php else: ?>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><?= $namasitus ?></h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="<?= BASE_URL ?>">Home</a>
      <a class="p-2 text-dark" href="<?= BASE_URL . "paket-wisata.php"  ?>">Paket Wisata</a>
      <a class="p-2 text-dark" href="<?= BASE_URL . "kontak-kami.php"  ?>">Kontak Kami</a>
    </nav>
    <?php if(isLogin()) : ?>
      <div class="dropdown show">
        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user"></i> <?= $_SESSION['user']['nama'] ?>
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="<?= BASE_URL . "profil.php"  ?>">Profil</a>
          <a class="dropdown-item" href="<?= BASE_URL . "password.php"  ?>">Ubah Password</a>
          <hr>
          <a class="dropdown-item" href="<?= BASE_URL . "logout.php" ?>">Log out</a>
        </div>
      </div>
    <?php else: ?>
      <a class="btn btn-outline-primary" href="<?= BASE_URL . "daftar.php"  ?>">Sign up</a>
    <?php endif ?>
  </div>
<?php endif; ?>

