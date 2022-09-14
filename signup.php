<?php session_start();

	if(isset($_SESSION['user'])) {
		header('Location: index.php');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$user = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_STRING);
		$password = $_POST['password'];
		$password2 = $_POST['confirm-password'];

		$error = '';

		if(empty($user) || empty($password) || empty($password2)) {
			$error = 'Please fill all the fields';
		} else if($password != $password2) {
			$error = "Passwords are not the same";
		} else {
			try {
				$connection = new PDO('mysql:host=containers-us-west-75.railway.app:6341;dbname=railway;', 'root', 'Yhmk6TE8xwaJ8vfBWkZT');
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			}

			$statement = $connection->prepare('SELECT * FROM users WHERE username = :user LIMIT 1;');
			$statement->execute(array(':user' => $user));
			$result = $statement->fetch();

			if($result != false) {
				$error = "The username already exists";
			}

			$password = hash('sha512', $password);
		}

		if($error == '') {
			$statement = $connection->prepare('INSERT INTO users (username, password) VALUES (:user, :password);');
			$statement->execute([':user' => $user, ':password' => $password]);

			header('Location: login.php');
		}
	}

	require 'views/signup.view.php';

?>
