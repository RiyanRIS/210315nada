<?php
	// variable declaration
	$nama = "";
	$username = "";
	$email    = "";
	$errors = array();

	$blokir = false;

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$nama = esc($_POST['nama']);
		$username = esc($_POST['username']);
		$email = esc($_POST['email']);
		$password_1 = esc($_POST['password_1']);
		$password_2 = esc($_POST['password_2']);
        $time = time();

		// form validation: ensure that the form is correctly filled
		if (empty($nama)) {  array_push($errors, "Maaf, nama kamu belum terisi"); }
		if (empty($username)) {  array_push($errors, "Kami harus memastikan kamu memiliki username"); }
		if (empty($email)) { array_push($errors, "Oops.. Email masih kosong"); }
		if (empty($password_1)) { array_push($errors, "Oh no, kamu melupakan kolom password"); }
		if ($password_1 != $password_2) { array_push($errors, "Konfirmasi password kamu belum cocok");}

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
			$password = password_hash($password_1, PASSWORD_DEFAULT);//encrypt the password before saving in the database
			$query = "INSERT INTO `users`
                            (`username`, `password`, `email`, `nama`, `create_at`)
                        VALUES
                            ('$username', '$password', '$email', '$nama', '$time')";
            if (!mysqli_query($conn, $query)) {
                array_push($errors, mysqli_error($conn));
            }

            // Log in to account if succeess registered
            if (count($errors) == 0) {
                // get id of created user
                $reg_user_id = mysqli_insert_id($conn);

                // put logged in user into session array
                $_SESSION['user'] = getUserById($reg_user_id);

                // if user is admin, redirect to admin area
                if ( in_array($_SESSION['user']['role'], ["admin"])) {
                    $_SESSION['message'] = "Selamat datang Admin ".$_SESSION['user']['nama'];
                    // redirect to admin area
                    header('location: ' . BASE_URL . 'admin/dashboard.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = "Kamu berhasil masuk";
                    // redirect to public area
                    header('location: index.php');
                    exit(0);
                }
            }
		}
	}

	// LOG USER IN
	if (isset($_POST['login_btn'])) {
		$username = esc($_POST['username']);
		$password = esc($_POST['password']);

		if (empty($username)) { array_push($errors, "Username/Email belum terisi"); }
		if (empty($password)) { array_push($errors, "Password belum terisi"); }
		if (empty($errors)) {
			// Cek username ada yang cocok atau enggak
			$sql = "SELECT id, `password`, `status` FROM users WHERE username='$username' LIMIT 1";
			$result = mysqli_query($conn, $sql);

			// Jika tidak, maka menggunakan email
			if (mysqli_num_rows($result) == 0) {
				$sql = "SELECT id, `password`, `status` FROM users WHERE email='$username' LIMIT 1";
				$result = mysqli_query($conn, $sql);
			}

			// Ada yang cocok atau enggak
			if (mysqli_num_rows($result) > 0) {
				$result = mysqli_fetch_assoc($result);
				if($result['status'] == 1){
					if(password_verify($password, $result['password'])){
						// get id of created user
						$reg_user_id = $result['id'];

						// put logged in user into session array and update last login
						$_SESSION['user'] = getUserById($reg_user_id);
						setLastLogin($reg_user_id);

						// if user is admin, redirect to admin area
						if ( in_array($_SESSION['user']['role'], ["admin"])) {
							$_SESSION['message'] = "Selamat datang Admin ".$_SESSION['user']['nama'];
							// redirect to admin area
							header('location: ' . BASE_URL . 'admin/dashboard.php');
							exit(0);
						} else {
							$_SESSION['message'] = "Kamu berhasil masuk";
							// redirect to public area
							header('location: index.php');
							exit(0);
						}	
					}
				}else{
					array_push($errors, 'Akun kamu terblokir, hubungi admin.');
					$blokir = true;
				}
			}
			if(!$blokir){
				array_push($errors, 'Kombinasi username dan password belum cocok');
			}
		}
	}

	// escape value from form
	function esc($value)
	{
		// bring the global db connect object into function
		global $conn;

		$val = trim($value); // remove empty space sorrounding string
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}
	// Get user info from user id
	function getUserById($id)
	{
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);

		// returns user in an array format:
		// ['id'=>1 'username' => 'Awa', 'email'=>'a@a.com', 'password'=> 'mypass']
		return $user;
	}
	// Last login user
	function setLastLogin($id):bool
	{
		global $conn; $time = time();
		$sql = "UPDATE `users` SET `last_login`='$time' WHERE `id` = '$id'";
		if (!mysqli_query($conn, $sql)) {
			return false;
		}
		return true;
	}
?>
