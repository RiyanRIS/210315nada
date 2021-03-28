<?php
$paket = "";
$user = "";
$tanggal_berangkat = "";
$jumlah_orang = "";
$unixpayment  = "";
$ket = "";
$tbb = "";

$errors = [];

/* - - - - - - - - - -
-  Pemesanan actions
- - - - - - - - - - -*/
// if user clicks the create user button
if (isset($_POST['create'])) {
	create($_POST);
}

function create($val){
	global $conn, $errors, $paket, $user, $tanggal_berangkat, $jumlah_orang, $unixpayment, $ket, $tbb;

  $tbb = $val['tbb'];

  $paket = $_GET['psnpaket'];
  $user = $_SESSION['user']['id'];

  $tanggal_berangkat = strtotime($val['tbb']);
  $jumlah_orang = esc($val['jumlah']);
  $ket = esc($val['ctt']);

  $unixpayment = rand(1,100);
	
	// form validation: ensure that the form is correctly filled
	if ($tanggal_berangkat<=strtotime("+48 hours")) { array_push($errors, "Minimal pemesanan harus 2 hari sebelum tanggal keberangkatan."); }
	if (empty($tanggal_berangkat)) { array_push($errors, "Waktu keberangkatan masih kosong."); }
	if (empty($jumlah_orang)) { array_push($errors, "Kolom jumlah orang masih kosong."); }

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$time = time();
		$query = "INSERT INTO `transaksi`
            (`paket`, `user`, `tanggal_berangkat`, `jumlah_orang`, `ket`, `unixpayment`, `create_at`) VALUES 
						('$paket', '$user', '$tanggal_berangkat', '$jumlah_orang', '$ket', '$unixpayment', '$time')";
		if (!mysqli_query($conn, $query)) {
			array_push($errors, mysqli_error($conn));
		}

		// Tampilkan pesan berhasil
		if (count($errors) == 0) {
			$_SESSION['last_id'] = mysqli_insert_id($conn);
			header("location: success.php");
			exit(0);
		}
	}
}

/* * * * * * * * * * * * * * * * * * * * *
* - Escapes form submitted value, hence, preventing SQL injection
* * * * * * * * * * * * * * * * * * * * * */
function esc($value){
	// bring the global db connect object into function
	global $conn;
	// remove empty space sorrounding string
	$val = trim($value);
	$val = mysqli_real_escape_string($conn, $value);
	return $val;
}