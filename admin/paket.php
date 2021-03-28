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
      List Paket Wisata 
      <a href="form_paket.php" class="btn btn-sm btn-primary" title="Tambah Data"  data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
      <a href="<?= BASE_URL ?>paket-wisata.php" target="_BLANK" class="btn btn-sm btn-primary" title="Lihat Halaman Paket"  data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i></a>
    </div>
    <div class="card-body small">
      <?php if (empty($paket)): ?>
        <h2 class="text-center">Paket wisata tidak ditemukan.</h2>
      <?php else: ?>
        <div class="table-responsive">
          <table class="table table-striped" id="datatable">
            <thead>
              <tr>
                <th>NAMA</th>
                <th>DESKRIPSI</th>
                <th>KUNJUNGAN</th>
                <th>HARGA</th>
                <th style="min-width:100px">#</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($paket as $key): ?>
                <tr>
                  <td>
                    <strong><?= $key['nama'] ?></strong>
                  </td>
                  <td>
                    <?= $key['deskripsi'] ?>
                  </td>
                  <td>
                    <?= ucwords($key['kunjungan']) ?>
                  </td>
                  <td>
                    <?= toRp($key['harga']) ?>
                  </td>
                  <td>
                    <a href="form_paket.php?edit=<?= $key['id'] ?>" title="Ubah" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>

                    <!-- <a href="users.php?change-user=<?= $key['id'] ?>" title="Aktif/Nonaktif" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" onclick="return confirm('are you sure?')"><i class="fa fa-eye"></i></a> -->

                    <a href="paket.php?delete=<?= $key['id'] ?>" title="Hapus" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" onclick="return confirm('are you sure?')"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      <?php endif ?>
    </div>
  </div>

</div>

<?php require_once( ROOT_PATH . '/admin/includes/_foot.php') ?>
    <script>
    $('input[type="checkbox"]').click(function(){
      if($(this).prop("checked") == true){
        $('input[name="password"]').attr("type","text");
      }
      else if($(this).prop("checked") == false){
        $('input[name="password"]').attr("type","password");
      }
    });
    </script>
  </body>
</html>