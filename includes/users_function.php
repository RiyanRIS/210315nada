<?php

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