<!-- PHP -->
<?php
	session_start();

	require "authenticate.php";

	if ($_SERVER["REQUEST_METHOD"] != "POST") {
		header("location: validate.php");
		die();
	}

	$authenticate = new authenticate();

	$checkResult = $authenticate -> verifyCode($_SESSION["auth_secret"], $_POST["code"], 2);

	if (!$checkResult) {
		$_SESSION["failed"] = true;
		header("location: validate.php");
		die();
	}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Authentication Conclusion</title>
		<style>
			* {
				margin: 0;
				padding: 0;
				box-sizing: border-box;
				font-family: Arial, Helvetica, sans-serif;
			}

			body {
				display: flex;
				font-size: 50px;
				justify-content: center;
				align-items: center;
				min-height: 100vh;
				background: linear-gradient(120deg, #00001F, #17F2AD);
				transition: 0,5s;
			}

			.fieldBlank {
				display: flex;
				justify-content: center;
				background: #fff;
				padding: 15px;
			}

			.title {
				align-items: center;
			}
		</style>
		<link rel="stylesheet" href="css/default.css">
	</head>
	<body>
		<div class="fieldBlank">
			<p class="title">Authentication concluded with success.</p>
		</div>
	</body>
</html>