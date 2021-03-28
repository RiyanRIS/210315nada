<?php 
	session_start();
	// connect to database

    $conn = mysqli_connect("localhost", "riyanris", "1234", "nada");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM information";
	$result = mysqli_query($conn, $sql);
	// fetch all posts as an associative array called $posts
	$information = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // define global constants
	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/nada/');
	$namasitus = $information[0]['namasitus'];

	// PUBLIC FUNCTON
	function isLogin():bool{
		if(isset($_SESSION['user'])){
			return true;
		}
		return false;
	}

	function isAdmin():bool{
		if($_SESSION['user']['role'] == 'admin'){
			return true;
		}
		return false;
	}

	function toRp($val){
		return "Rp " . number_format($val,0,',','.');
	}
?>