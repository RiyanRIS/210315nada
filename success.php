<?php require_once('config.php') ?>
<?php require_once('includes/transaksi_function.php') ?>
<?php require_once('includes/paket_function.php') ?>
<?php 
$id = $_SESSION['last_id'];
$transaksi = getTransaksiById($id);

$paket = getPaketById($transaksi['paket']);

$bayar = $paket['harga']+$transaksi['unixpayment'];

$sebelum = strtotime("+2 days", $transaksi['create_at']);
$sebelum = date("d F Y H:i:s", $sebelum);

?>

<?php require_once( ROOT_PATH . '/includes/_head.php') ?>
	<title> Berhasil Memsan | <?= $namasitus ?> </title>
</head>
<body>
    
<?php require_once( ROOT_PATH . '/includes/_nav.php') ?>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto">
  <h1 class="display-4  text-center">Berhasil Melakukan Pemesanan.</h1>
  <p class="lead  text-center">Silahkan melakukan pembayaran sebesar <span class="badge badge-success" style="font-size:19px"> <?= toRp($bayar) ?></span> sebelum <br><br> <span class="badge badge-primary text-center h2" style="font-size:24px"><?= $sebelum ?></span>.</p> <br><br>
  <hr>
  <p>Pembayaran dapat dilakukan melalui:</p>
  <ul>
    <li>BANK BRI: NOMOR_REKENING (ATAS_NAMA) </li>
    <li>BANK BNI: NOMOR_REKENING (ATAS_NAMA) </li>
    <li>BANK BCA NOMOR_REKENING (ATAS_NAMA) </li>
  </ul>
  <p>Status pemesanan kamu dapat dilihat <a href="transaksi.php">disini</a>.</p>
    
</div>

<?php require_once( ROOT_PATH . '/includes/_foot.php') ?>
    
  </body>
</html>