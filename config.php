<?php
session_start();
// connect to database
// mysql://b0486600872966:54367e15@us-cdbr-east-03.cleardb.com/heroku_c9c5963cf86d4fd?reconnect=true
$conn = mysqli_connect("us-cdbr-east-03.cleardb.com", "b0486600872966", "54367e15", "heroku_c9c5963cf86d4fd");

if (!$conn) {
	die("Error connecting to database: " . mysqli_connect_error());
}

$sql = "SELECT * FROM information";
$result = mysqli_query($conn, $sql);
// fetch all posts as an associative array called $posts
$information = mysqli_fetch_all($result, MYSQLI_ASSOC);

// define global constants
define('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'https://nada029.herokuapp.com/');
$namasitus = $information[0]['namasitus'];

// PUBLIC FUNCTON
function isLogin(): bool
{
	if (isset($_SESSION['user'])) {
		return true;
	}
	return false;
}

function esc($value)
{
	global $conn;
	$val = trim($value);
	$val = mysqli_real_escape_string($conn, $value);
	return $val;
}

function isAdmin(): bool
{
	if (@$_SESSION['user']['role'] == 'admin') {
		return true;
	}
	return false;
}

function toRp($val)
{
	return "Rp " . number_format($val, 0, ',', '.');
}
