<?php

$nama = "";
$username = "";
$email = "";
$pw = "";
$pw1 = "";
$pw2 = "";

$errors = [];

function getAllUsers()
{
	global $conn;

	$sql = "SELECT * FROM users ORDER BY `role` ASC, last_login DESC";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getUsersById($user_id)
{
	global $conn;
	$sql = "SELECT * FROM users WHERE id=$user_id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return mysqli_fetch_assoc($result);
	} else {
		return null;
	}
}

if(isset($_GET['psnusers'])){
	$user = getUsersById($_SESSION['user']['id']);
	$nama = $user['nama'];
	$email = $user['email'];
}

if(isset($_POST['resetpw'])){
	resetPw($_POST);
}

if(isset($_POST['updateuser'])){
	updateUser($_POST);
}

function resetPw($val){
	global $conn, $errors, $pw, $pw1, $pw2;
	
	$pw = esc($val['pw']);
	$pw1 = esc($val['pw1']);
	$pw2 = esc($val['pw2']);

	if (empty($pw)) { array_push($errors, "Kolom password masih kosong"); }
	if (empty($pw1)) { array_push($errors, "Kolom password baru masih kosong"); }
	if (empty($pw2)) { array_push($errors, "Kolom konfirmasi password baru masih kosong"); }
	if($pw1 != $pw2){ array_push($errors, "Konfirmasi password baru belum cocok."); }

	$id = $_SESSION['user']['id'];
	$user = getUsersById($id);
	if(count($errors) == 0){
		if(password_verify($pw, $user['password'])){
			$pwh = password_hash($pw1 ,PASSWORD_DEFAULT);
			$query = "UPDATE `users` SET `password`='$pwh' WHERE `id`='$id'";
			if (!mysqli_query($conn, $query)) {
				array_push($errors, mysqli_error($conn));
			}
		}else{
			array_push($errors, "Password lama belum tepat.");
		}
	}

	// Tampilkan pesan berhasil
	if (count($errors) == 0) {
		$_SESSION['message'] = "Password successfully updated";
		header("location: password.php");
		exit(0);
	}

}

function updateUser($val){
	global $conn, $errors, $nama, $username, $email;

	$id = $_SESSION['user']['id'];
	
	$nama = esc($val['nama']);
	$username = esc($val['username']);
	$email = esc($val['email']);

	// form validation: ensure that the form is correctly filled
	if (empty($nama)) { array_push($errors, "Nama masih kosong"); }
	if (empty($username)) { array_push($errors, "Uhmm...We gonna need the username"); }
	if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }

	// Ensure that no user is registered twice.
	// the email and usernames should be unique
	$user_check_query = "SELECT * FROM users WHERE username='$username'
								OR email='$email' LIMIT 1";

	$result = mysqli_query($conn, $user_check_query);
	$user = mysqli_fetch_assoc($result);

	if ($user && $user['id'] != $id) { // if user exists
		if ($user['username'] === $username) {
		  array_push($errors, "Username sudah digunakan");
		}

		if ($user['email'] === $email) {
		  array_push($errors, "Email sudah digunakan");
		}
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {

		$query = "UPDATE `users` SET `nama`='$nama', `username`='$username', `email`='$email' WHERE `id`=$id";
		if (!mysqli_query($conn, $query)) {
			array_push($errors, mysqli_error($conn));
		}
	}

	// Tampilkan pesan berhasil
	if (count($errors) == 0) {
		$_SESSION['message'] = "Users successfully updated";
		header("location: profil.php");
		exit(0);
	}
}
