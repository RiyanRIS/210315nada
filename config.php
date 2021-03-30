<?php 
	session_start();
	// connect to database
	// mysql://b6b2e6d5c07934:2b7ebf2e@us-cdbr-east-03.cleardb.com/heroku_392495a3c1606ed?reconnect=true 
	$conn = mysqli_connect("us-cdbr-east-03.cleardb.com", "b6b2e6d5c07934", "2b7ebf2e", "heroku_392495a3c1606ed");

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

	function esc($value){
		global $conn;
		$val = trim($value);
		$val = mysqli_real_escape_string($conn, $value);
		return $val;
	}

	function isAdmin():bool{
		if(@$_SESSION['user']['role'] == 'admin'){
			return true;
		}
		return false;
	}

	function toRp($val){
		return "Rp " . number_format($val,0,',','.');
	}
?>