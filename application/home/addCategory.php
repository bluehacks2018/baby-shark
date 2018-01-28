<?php
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
	<link href="_css/fontawesome-all.min.css" rel="stylesheet">
	<style type="text/css">
		html, body {
			height: 100%;
		}

		body {
			
			background-color: #f5f5f5;
		}

		.form-signin {
			width: 100%;
			max-width: 350px;
			padding: 15px;
			margin: 0 auto;
		}

		.form-signin .checkbox {
			font-weight: 400;
		}

		.form-signin .form-control {
			position: relative;
			box-sizing: border-box;
			height: auto;
			padding: 10px;
			font-size: 16px;
		}

		.form-signin .form-control:focus {
			z-index: 2;
		}

		.form-signin input {
			margin-bottom: 10px;
			border-bottom-right-radius: 0;
			border-bottom-left-radius: 0;
		}

		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
			-webkit-appearance: none; 
			margin: 0; 
		}
	</style>
</head>

<body>

	<?php 

		if(isset($_GET['num']) && isset($_GET['catname'])) {
	?>

	<form class="form-signin" method="get">
		<h1 class="h3 mb-3 font-weight-normal"><center>Add Questions</center></h1><br />

		<?php
			for($i = 0; $i < $_GET['num']; $i++) {
			$count = $i + 1;
		?>
		<label for="inputQuestion<?php echo $count ?>">Question #<?php echo $count ?></label>
		<input type="text" id="inputCat" name="inputQuestion<?php echo $count ?>" class="form-control" placeholder="Question" required autofocus>
		<?php }  ?>

		<br /><br />
		<button class="btn btn-lg btn-danger btn-block" type="submit">Add</button>
	</form>
	<?php
		} else {
	?>
	<form class="form-signin" method="get">
		<h1 class="h3 mb-3 font-weight-normal"><center>Add Category</center></h1><br />
		<label for="catname">Category Name</label>
		<input type="text" name="catname" class="form-control" placeholder="Category name" required autofocus>

		<label for="num">Number of Questions</label>
		<input type="number" name="num" class="form-control" placeholder="0" required autofocus>

		<br /><br />
		<button class="btn btn-lg btn-danger btn-block" type="submit">Next</button>
	</form>
	<?php } ?>
	<center><p class="mt-5 mb-3 text-muted">&copy; Team Baby Shark</p></center>
	<script type="text/javascript"></script>
</body>
</html>
