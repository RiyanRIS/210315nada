<?php
define(REDIRECT, "location: transaksi.php");

function getTransaksiById($id)
{
	global $conn;
	$sql = "SELECT * FROM `transaksi` WHERE `id`=$id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return mysqli_fetch_assoc($result);
	} else {
		return null;
	}
}

function getTransaksiByUser($user)
{
	global $conn;
	$sql = "SELECT a.* , b.id idpaket, b.nama namapaket FROM `transaksi` a 
            INNER JOIN `paket` b ON a.paket = b.id
            WHERE a.user='$user'";
	$result = mysqli_query($conn, $sql);
  return mysqli_fetch_all($result, MYSQLI_ASSOC);
}


/* - - - - - - - - - -
-  Transaksi actions
- - - - - - - - - - -*/
if(isset($_GET['batal'])){
  batal($_GET['batal']);
}


/* - - - - - - - - - - - -
-  Transaksi functions
- - - - - - - - - - - - -*/

function batal($id){
  global $conn;
  $time = time();

  $query = "UPDATE `transaksi` SET `status_pemesanan`=3, `batal_at`='$time' WHERE `id`='$id'";
  if (!mysqli_query($conn, $query)) {
    array_push($errors, mysqli_error($conn));
  }

  // Tampilkan pesan berhasil
  if (count($errors) == 0) {
    $_SESSION['message'] = "Transaksi successfully canceled";
    header(REDIRECT);
    exit(0);
  }
}