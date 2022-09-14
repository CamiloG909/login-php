<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#1CCC5B" />
	<link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="styles/styles.css">
	<title>Sign up | PHP</title>
</head>
<body>
<header class="header">
		<img src="assets/logo.png" alt="Logo header">
	</header>
	<main>
		<form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
			<p class="form__title">Sign up</p>
			<div class="form__input-container">
				<i class="bi bi-person-fill form__icon"></i>
				<input class="form__input" type="text" name="user" placeholder="Username" style="text-transform: lowercase;">
			</div>
			<div class="form__input-container">
			<i class="bi bi-lock-fill form__icon"></i>
			<input class="form__input" type="password" name="password" placeholder="Password">
			</div>
			<div class="form__input-container">
			<i class="bi bi-lock-fill form__icon"></i>
			<input class="form__input" type="password" name="confirm-password" placeholder="Confirm password">
			</div>
			<button class="form__btn">Register <i class="bi bi-person-plus-fill"></i></button>
		</form>
		<?php if(!empty($error)): ?>
			<p class="error-box"><i class="bi bi-exclamation-triangle-fill"></i> <?php echo $error ?></p>
		<?php endif; ?>
		<div class="links">
			<p class="links__text">You have an account?</p>
			<a class="links__a" href="login.php">Sign in</a>
		</div>
	</main>
</body>
</html>
