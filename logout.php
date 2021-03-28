<?php 
	session_start();
	session_unset($_SESSION['user']);
	session_destroy();
	session_start();
    $_SESSION['message'] = "Kamu berhasil keluar";
	header('location: index.php');
?>