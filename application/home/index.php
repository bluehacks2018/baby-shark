<?php
	include '_inc/site-core/functions.php';

	if(isset($_POST['login'])) {
		$phone = $_POST['phone'];
		if(checkUserExist($phone, $conn)) {
			if(sendCode($phone, $conn)) {
				header('Location: ?sent=yes&phone=' . $phone);
			}else{
				echo "error 2";
			}
		}else{
			echo "error 1";
		}
	}

	if(isset($_POST['loginCode'])) {
		if(checkCode($_POST['code'], $_POST['phone'], $conn)) {
			header('Location: ./home.php');
		
		}

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#D64A4A" />

	<title>#AskJuan</title>

	<link href="_css/bootstrap.css" rel="stylesheet">
	<link href="_css/global.css" rel="stylesheet">
	<link href="_css/fontawesome-all.min.css" rel="stylesheet">
</head>

<body class="text-center">
	<?php
		if(isset($_GET['sent']) && $_GET['sent'] == "yes") {
	?>
	<form class="form-signin" method="post">
		<img class="mb-4" src="./_images/logo.svg" alt="" width="102" height="102">
		<br/><br/><label for="inputEmail">Verification Code</label>
		<input type="number" name="code" class="form-control" placeholder="XXXX" required autofocus>
		<input type="hidden" name="phone" value="<?php echo '+63' . $_GET['phone']; ?>">
		<button class="btn btn-lg btn-danger btn-block" name="loginCode" type="submit">Request Code</button>
		<p class="mt-5 mb-3 text-muted">&copy; Team Baby Shark</p>
	</form>

	<?php
		} else {
	?>
	<form class="form-signin" method="post">
		<img class="mb-4" src="./_images/logo.svg" alt="" width="102" height="102">
		<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
		<label for="inputEmail" class="sr-only">Phone Number</label>
		<input type="number" name="phone" class="form-control" placeholder="906 XXX XXXX" required autofocus>
		<button class="btn btn-lg btn-danger btn-block" name="login" type="submit">Request Code</button>
		<p class="mt-5 mb-3 text-muted">&copy; Team Baby Shark</p>
	</form>

	<?php } ?>
	<script type="text/javascript"></script>
</body>
</html>
