<?php
	include "_inc/site-core/functions.php";

	if(isset($_POST['register'])) {
		// $_SERVER['DOCUMENT_ROOT'];
		$fdir = "./uploads/";
		$fname = basename($_FILES["inputPicture"]["name"]);
		$ext = pathinfo($fname,PATHINFO_EXTENSION);
		$uploadOk = 1;

		$target_file = $fdir.$fname.$ext;
		// Check if image file is a actual image or fake image
		$tmp = $_FILES["inputPicture"]["tmp_name"];
		$check = getimagesize($tmp);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$msg .= "File is not an image.";
			$uploadOk = 0;
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			$msg .= "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["inputPicture"]["size"] > 50000000) {
			$msg .= "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if( $ext != "png" && $ext != "jpg" && $ext != "jpeg" && $ext != "bmp") {
			$msg .= "Only PNG, JPG, and BMP are allowed";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk === 0) {
			$msg .= "Error Occured";
		} else {

			$img = str_replace(array('.',' '), array('',''), microtime()) . "." . $ext;
			if (move_uploaded_file($_FILES["inputPicture"]["tmp_name"], $fdir.$img)) {
				// SQL HERE
				$fname = $_POST['inputFname'];
				$mname = $_POST['inputMname'];
				$lname = $_POST['inputLname'];
				$gender = $_POST['inputGender'];
				$street = $_POST['inputStreet'];
				$city = $_POST['inputCity'];
				$brgy = $_POST['inputBarangay'];
				$state = $_POST['inputState'];
				$phone = $_POST['inputPhone'];

				if(registerUser($fname, $mname, $lname, $gender, $street, $city, $brgy, $state, $phone, $img, $conn)) {
					echo "Registered";
				}else{
					echo "Failed";
				}
			}
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
			max-width: 330px;
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
	<form class="form-signin" method="post" enctype="multipart/form-data">
		<h1 class="h3 mb-3 font-weight-normal"><center>Register</center></h1><br />
		<label for="inputFname">First Name</label>
		<input type="text" id="inputFname" name="inputFname" class="form-control" placeholder="Juan" required autofocus>

		<label for="inputMiddle">Middle Name</label>
		<input type="text" id="inputMiddle" name="inputMname" class="form-control" placeholder="Santiago" required>

		<label for="inputLast">Last Name</label>
		<input type="text" id="inputLast" name="inputLname" class="form-control" placeholder="Dela Cruz" required>
		<br />
		<label for="inputGender">Gender</label><br />
		<input type="radio" name="inputGender" value="m" required> Male<br />
		<input type="radio" name="inputGender" value="f" required> Female<br /><br />

		<label for="inputStreet">Street</label>
		<input type="text" id="inputStreet" name="inputStreet" class="form-control" placeholder="Canonico Street" required>

		<label for="inputCity">City</label>
		<select name="inputCity" class="form-control" required>
			<option disabled selected>Please select...</option>
			<option value="1">City</option>
		</select>

		<label for="inputBarangay">Barangay</label>
		<input type="text" id="inputBarangay" name="inputBarangay" class="form-control" placeholder="Poblacion II" required>

		<label for="inputState">State</label>
		<input type="text" id="inputState" name="inputState" class="form-control" placeholder="State" required>

		<label for="inputPhone">Phone Number</label>
		<input type="number" id="inputPhone" name="inputPhone" class="form-control" placeholder="906 XXX XXXX" required>

		<label for="inputPicture">Picture</label>
		
		<input type="file" name="inputPicture" />
		<br /><br />
		<button class="btn btn-lg btn-danger btn-block" type="submit" name="register">Register</button>
		<p class="mt-5 mb-3 text-muted">&copy; Team Baby Shark</p>
	</form>
	<script type="text/javascript"></script>
</body>
</html>
