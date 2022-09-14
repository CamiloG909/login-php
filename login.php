<?php session_start();

	if(isset($_SESSION['user'])) {
		header('Location: index.php');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$user = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_STRING);
		$password = $_POST['password'];
		$password = hash('sha512', $password);

		$error = '';

		if(empty($user) || empty($password)) {
			$error = 'Please complete the credentials';
		} else {
			try {
				$connection = new PDO('mysql:host=containers-us-west-75.railway.app:6341;dbname=railway;', 'root', 'Yhmk6TE8xwaJ8vfBWkZT');
			} catch (PDOException $e) {
				echo 'Error: ' . $e->getMessage();
			}

			$statement = $connection->prepare('SELECT password FROM users WHERE username = :user AND password = :password LIMIT 1;');
			$statement->execute([':user' => $user, ':password' => $password]);
			$result = $statement->fetch();

			if($result == false) {
				$error = 'Verify your credentials';
			}

			if($error == '' && $result != false) {
				$_SESSION['user'] = $user;
				header('Location: index.php');
			}
		}

	}

	require 'views/login.view.php';

?>
