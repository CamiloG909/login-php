<?php session_start();

	if(!isset($_SESSION['user'])) {
		header('Location: login.php');
	}

require 'views/index.view.php';

?>
