<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/transaksi_function.php'); ?>
<?php
  $transaksi = getAllTransaksi();
?>

<?php require_once( ROOT_PATH . '/admin/includes/_head.php') ?>
	<title> Transkasi Page | <?= $namasitus ?> </title>
</head>
<body>
    
<?php require_once( ROOT_PATH . '/admin/includes/_nav.php') ?>
<div class="container">
  <div class="card">
    <div class="card-header">
      List Transaksi 
    </div>
    <div class="card-body small">
      <?php if (empty($transaksi)): ?>
        <h2 class="text-center">Transaksi tidak ditemukan.</h2>
      <?php else: ?>
        <div class="table-responsive">
          <table class="table table-striped" id="datatable">
            <thead>
              <tr>
                <th>TANGGAL</th>
                <th>PAKET</th>
                <th>TANGGAL BERANGKAT</th>
                <th>STATUS</th>
                <th style="min-width:100px">#</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($transaksi as $key): ?>
                <tr>
                  <td>
                    <?= date("d F Y H:i:s", $key['create_at']) ?>
                  </td>
                  <td>
                    <a href="<?= BASE_URL ?>detail_paket.php?id=<?= $key['idpaket'] ?>"><?= $key['namapaket'] ?></a>
                  </td>
                  <td>
                    <?= date("d F Y H:i:s", $key['tanggal_berangkat']) ?>
                  </td>
                  <td>
                    <?php if($key['status_pemesanan'] == 1): ?>
                      <span class="badge badge-info">Menunggu Pembayaran</span>
                    <?php elseif($key['status_pemesanan'] == 2): ?>
                      <span class="badge badge-success">Pembayaran Berhasil</span>
                    <?php elseif($key['status_pemesanan'] == 3): ?>
                      <span class="badge badge-danger">Dibatalkan</span>
                    <?php endif; ?>
                  </td>
                  <td>
                  <a href="<?= BASE_URL ?>detail_transaksi.php?id=<?= $key['id'] ?>" title="Lihat Detail" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i></a> 
                  
                  <?php if($key['status_pemesanan'] == 1): ?> ||
                    <a href="transaksi.php?berhasil=<?= $key['id'] ?>" title="Pembayaran Diterima" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" onclick="return confirm('are you sure?')"><i class="fa fa-check"></i></a>
                    <a href="transaksi.php?batal=<?= $key['id'] ?>" title="Batalkan" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" onclick="return confirm('are you sure?')"><i class="fa fa-times"></i></a>
                  <?php endif; ?>
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
   
  </body>
</html>