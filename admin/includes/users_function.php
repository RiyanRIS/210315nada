<?php
define(REDIRECT,'location: users.php');
// User variables
$id = 0;
$username = "";
$password = "";
$email = "";
$nama = "";
$role = "";
$status = "";
$last_login = "";
$create_at = "";
$delete_at = "";

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

/* - - - - - - - - - -
-  Admin users actions
- - - - - - - - - - -*/
// if user clicks the create user button
if (isset($_POST['create_user'])) {
	createUser($_POST);
}
// if user clicks the Edit user button
if (isset($_GET['edit-user'])) {
	$isEditingUser = true;
	$user_id = $_GET['edit-user'];
	editUser($user_id);
}
// if user clicks the update user button
if (isset($_POST['update_user'])) {
	updateUser($_POST);
}
// if user clicks the Delete user button
if (isset($_GET['delete-user'])) {
	$user_id = $_GET['delete-user'];
	deleteUser($user_id);
}
// if user clicks the Change status user button
if (isset($_GET['change-user'])) {
	$user_id = $_GET['change-user'];
	changeUser($user_id);
}


/* - - - - - - - - - - - -
-  Admin users functions
- - - - - - - - - - - - -*/
function createUser($val){
	global $conn, $errors, $role, $username, $email, $nama, $password;
	
	$nama = esc($val['nama']);
	$username = esc($val['username']);
	$email = esc($val['email']);
	$role = esc($val['role']);
	$password = esc($val['password']);

	// form validation: ensure that the form is correctly filled
	if (empty($nama)) { array_push($errors, "Nama masih kosong"); }
	if (empty($username)) { array_push($errors, "Uhmm...We gonna need the username"); }
	if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
	if (empty($role)) { array_push($errors, "Role is required for users");}
	if (empty($password)) { array_push($errors, "uh-oh you forgot the password"); }
	
	// Ensure that no user is registered twice.
	// the email and usernames should be unique
	$user_check_query = "SELECT * FROM users WHERE username='$username'
								OR email='$email' LIMIT 1";

	$result = mysqli_query($conn, $user_check_query);
	$user = mysqli_fetch_assoc($result);

	if ($user) { // if user exists
		if ($user['username'] === $username) {
		  array_push($errors, "Username sudah digunakan");
		}

		if ($user['email'] === $email) {
		  array_push($errors, "Email sudah digunakan");
		}
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$time = time();
		$password = password_hash($password, PASSWORD_DEFAULT);//encrypt the password before saving in the database
		$query = "INSERT INTO `users`
						(`username`, `password`, `email`, `nama`, `role`, `create_at`)
					VALUES
						('$username', '$password', '$email', '$nama', '$role', '$time')";
		if (!mysqli_query($conn, $query)) {
			array_push($errors, mysqli_error($conn));
		}

		// Tampilkan pesan berhasil
		if (count($errors) == 0) {
			$_SESSION['message'] = "User successfully created";
			header(REDIRECT);
			exit(0);
		}
	}
}

function editUser($id){
	global $conn, $username, $role, $email, $nama;

	$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);

	$username = $user['username'];
	$email = $user['email'];
	$role = $user['role'];
	$nama = $user['nama'];
}

function updateUser($val){
	global $conn, $errors, $role, $username, $isEditingUser, $id, $email, $nama, $password;
	
	// get id of the admin to be updated
	$id = $val['user_id'];

	// isi variabel yang akan dirubah
	$nama = esc($val['nama']);
	$username = esc($val['username']);
	$email = esc($val['email']);
	$role = esc($val['role']);

	// form validation: ensure that the form is correctly filled
	if (empty($nama)) { array_push($errors, "Nama masih kosong"); }
	if (empty($username)) { array_push($errors, "Uhmm...We gonna need the username"); }
	if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
	if (empty($role)) { array_push($errors, "Role is required for users");}

	// Ensure that no user is registered twice.
	// the email and usernames should be unique
	$user_check_query = "SELECT * FROM `users` WHERE `username`='$username'
								OR `email`='$email'";

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

		$query = "UPDATE `users` SET `nama`='$nama', `username`='$username', `email`='$email', `role`='$role' WHERE `id`=$id";
		if (!mysqli_query($conn, $query)) {
			array_push($errors, mysqli_error($conn));
		}

		// JIka kolom password di isi berarti ikut dirubah juga
		if (!empty($val['password'])){
			$password = esc($val['password']);
			//encrypt the password (security purposes)
			$password = password_hash($password, PASSWORD_DEFAULT);//encrypt the password before saving in the database

			$query = "UPDATE `users` SET `password`='$password' WHERE `id`=$id";
			if (!mysqli_query($conn, $query)) {
				array_push($errors, mysqli_error($conn));
			}
		}

		// Tampilkan pesan berhasil
		if (count($errors) == 0) {
			// set edit state to false
			$isEditingUser = false;
			
			$_SESSION['message'] = "User successfully updated";
			header(REDIRECT);
			exit(0);
		}
	}
}

function deleteUser($id) {
	global $conn, $errors;
	$sql = "DELETE FROM users WHERE id=$id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "User successfully deleted";
		header(REDIRECT);
		exit(0);
	}else{
		array_push($errors, mysqli_error($conn));
	}
}

function changeUser($id) {
	global $conn, $errors, $status;
	$sql = "SELECT `status` FROM users WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);

	// Ubah val pada status, 1=active 0=Suspended
	if($user['status']==1){
		$status = 0;
	}else{
		$status = 1;
	}

	$query = "UPDATE `users` SET `status`='$status' WHERE `id`=$id";
	if (!mysqli_query($conn, $query)) {
		array_push($errors, mysqli_error($conn));
	}

	// Tampilkan pesan berhasil
	if (count($errors) == 0) {
		$_SESSION['message'] = "User successfully updated";
		header(REDIRECT);
		exit(0);
	}
	
}


?>
