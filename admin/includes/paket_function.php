<?php
define(REDIRECT,'location: paket.php');
// User variables
$id = 0;
$nama = "";
$deskripsi = "";
$kunjungan = "";
$gambar = "";
$harga = "";
$status = "";

$target_dir = ROOT_PATH . "/assets/uploads/";

$errors = [];

function getAllPaket()
{
	global $conn;

	$sql = "SELECT * FROM `paket` WHERE `delete_at` IS NULL ORDER BY `id` DESC";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getPaketById($user_id)
{
	global $conn;
	$sql = "SELECT * FROM paket WHERE id=$user_id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return mysqli_fetch_assoc($result);
	} else {
		return null;
	}
}

/* - - - - - - - - - -
-  Admin users actions
- - - - - - - - - - -*/
// if user clicks the create user button
if (isset($_POST['create'])) {
	create($_POST);
}
// if user clicks the Edit user button
if (isset($_GET['edit'])) {
	$isEditing = true;
	$id = $_GET['edit'];
	edit($id);
}
// if user clicks the Delete user button
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	delete($id);
}


/* - - - - - - - - - - - -
-  Admin users functions
- - - - - - - - - - - - -*/
function create($val){
	global $conn, $errors, $nama, $deskripsi, $kunjungan, $harga, $target_dir;
	
	$nama = esc($val['nama']);
	$deskripsi = esc($val['deskripsi']);
	$kunjungan = esc($val['kunjungan']);
	$harga = esc($val['harga']);

	$nama_gambar = "";

	// form validation: ensure that the form is correctly filled
	if (empty($nama)) { array_push($errors, "Kolom nama masih kosong"); }
	if (empty($deskripsi)) { array_push($errors, "Kolom deskripsi masih kosong"); }
	if (empty($kunjungan)) { array_push($errors, "Kolom kunjungan masih kosong"); }
	if (empty($harga)) { array_push($errors, "Kolom harga masih kosong");}

	if(!empty($_FILES["gambar"]["name"])){
		$nama_gambar = upload_img($_FILES["gambar"]);
	}
	
	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$time = time();
		$query = "INSERT INTO `paket`
						(`nama`, `deskripsi`, `kunjungan`, `harga`, `create_at`) 
							VALUES 
						('$nama', '$deskripsi', '$kunjungan', '$harga', '$time')";
		if (!mysqli_query($conn, $query)) {
			array_push($errors, mysqli_error($conn));
		}

		if(!empty($_FILES["gambar"]["name"])){
			// get id of created user
			$last_id = mysqli_insert_id($conn);
			
			$query = "UPDATE `paket` SET `gambar`='$nama_gambar' WHERE `id`='$last_id'";
			if (!mysqli_query($conn, $query)) {
				array_push($errors, mysqli_error($conn));
			}
		}

		// Tampilkan pesan berhasil
		if (count($errors) == 0) {
			$_SESSION['message'] = "Paket successfully created";
			header(REDIRECT);
			exit(0);
		}
	}
}

function edit($id){
	global $conn, $nama, $deskripsi, $kunjungan, $harga, $gambar;

	$sql = "SELECT * FROM `paket` WHERE `id`='$id' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);

	$nama = $user['nama'];
	$deskripsi = $user['deskripsi'];
	$kunjungan = $user['kunjungan'];
	$harga = $user['harga'];
	$gambar = $user['gambar'];
}

function update($val){
	global $conn, $errors, $id, $nama, $deskripsi, $kunjungan, $harga, $gambar, $target_dir;
	
	// get id of the admin to be updated
	$id = $val['id'];

	$nama = esc($val['nama']);
	$deskripsi = esc($val['deskripsi']);
	$kunjungan = esc($val['kunjungan']);
	$harga = esc($val['harga']);

	$nama_gambar = "";

	// form validation: ensure that the form is correctly filled
	if (empty($nama)) { array_push($errors, "Kolom nama masih kosong"); }
	if (empty($deskripsi)) { array_push($errors, "Kolom deskripsi masih kosong"); }
	if (empty($kunjungan)) { array_push($errors, "Kolom kunjungan masih kosong"); }
	if (empty($harga)) { array_push($errors, "Kolom harga masih kosong");}

	if(!empty($_FILES["gambar"]["name"])){
		$nama_gambar = upload_img($_FILES["gambar"]);
		
		// Hapus gambar yang lama
		$rm_gambar = $val['rm_gambar'];
		if (file_exists($target_dir.$rm_gambar)) {
			unlink($target_dir.$rm_gambar);
		}
	}
	
	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$query = "UPDATE `paket` SET `nama`='$nama',`deskripsi`='$deskripsi',`kunjungan`='$kunjungan',`harga`='$harga' WHERE `id`='$id'";
		if (!mysqli_query($conn, $query)) {
			array_push($errors, mysqli_error($conn));
		}

		if(!empty($_FILES["gambar"]["name"])){
			$query = "UPDATE `paket` SET `gambar`='$nama_gambar' WHERE `id`='$id'";
			if (!mysqli_query($conn, $query)) {
				array_push($errors, mysqli_error($conn));
			}
		}

		// Tampilkan pesan berhasil
		if (count($errors) == 0) {
			$_SESSION['message'] = "Paket successfully updated";
			header(REDIRECT);
			exit(0);
		}
	}
}

function delete($id) {
	global $conn, $errors;
	$time = time();

	$sql = "UPDATE `paket` SET `delete_at`='$time' WHERE `id`='$id'";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "Paket successfully deleted";
		header(REDIRECT);
		exit(0);
	}else{
		array_push($errors, mysqli_error($conn));
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

function upload_img($img){
	global $target_dir, $errors;

	$nama_gambar = time() . "-" . basename($img['name']);
	$target_file = $target_dir . $nama_gambar;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	$check = getimagesize($img["tmp_name"]);
	if(!$check) {
		array_push($errors, "File is not an image.");	
	}
	
	// Check if file already exists
	if (file_exists($target_file)) {
		array_push($errors, "Sorry, file already exists.");	
	}

	// Check file size
	if ($img["size"] > 2000000) {
		array_push($errors, "Sorry, your file is too large. (Max: 2MB)");	
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");	
	}

	// Check if $uploadOk is set to 0 by an error
	if(count($errors) == 0 ){
		if (!move_uploaded_file($img["tmp_name"], $target_file)){
			array_push($errors, "Sorry, there was an error uploading your file.");	
		}
	}
	return $nama_gambar;
}

?>
