<?php
$nama_paket = "";
$deskripsi = "";
$kunjungan = "";
$harga = "";

$errors = [];

function getAllPaket()
{
	global $conn;

	$sql = "SELECT * FROM `paket` WHERE `delete_at` IS NULL ORDER BY `id` DESC";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getPaketById($id)
{
	global $conn;
	$sql = "SELECT * FROM `paket` WHERE `id`=$id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return mysqli_fetch_assoc($result);
	} else {
		return null;
	}
}

if(isset($_GET['psnpaket'])){
	$user = getPaketById($_GET['psnpaket']);
	$nama_paket = $user['nama'];
	$deskripsi = $user['deskripsi'];
	$kunjungan = $user['kunjungan'];
	$harga = $user['harga'];
}