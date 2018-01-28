<?php
	include "_inc/site-core/conn.php";
	ini_set('Display_errors', true); 
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
	<link href="_css/home.css" rel="stylesheet">
	<link href="_css/fontawesome-all.min.css" rel="stylesheet">
</head>

<body>

	<?php
		if(isset($_GET['category'])) {
			$stmt = $conn->prepare("SELECT * FROM category WHERE id = ? LIMIT 1");
			$stmt->bind_param("i", $_GET['category']);
			$stmt->execute();
			$stmt->bind_result($id, $name);
			$stmt->fetch();
	?>

	<nav>
		<a href="./home.php"><i class="fas fa-arrow-left backArrow"></i></a>
		<button type="button" class="toggle">
			<span class="hamburger"></span>
			<span class="hamburger"></span>
			<span class="hamburger"></span>
		</button>
	</nav>
	<div class="nav-dropdown">
		<ul>
			<li>Your Name</li>
			<li>Logout</li>
		</ul>
	</div>

	<div class="question-content">
		<h1><?php echo $name ?></h1>
		<div class="container">
			<p>
				<form method="post">
					<?php
						$stmt2 = $conn->prepare("SELECT * FROM questions WHERE category_id = ?");
						$stmt2->bind_param("i", $_GET['category']);
					?>
					<span class="question-title"><?php echo $count . ". " . $question ?></span><br />
					<div class="yes-no">
						<input type="radio" name="question1" value="yes" /> <span class="question-p">Yes</span><br />
						<input type="radio" name="question1" value="no" /> <span class="question-p">No</span>
					</div>
					<br /><br />
					<button class="btn btn-lg btn-primary btn-block lapad" type="submit">Submit</button>
				</form>
			</p>
		</div>
	</div>
	<?php
			
		} else { ?>

	<nav>
		<button type="button" class="toggle">
			<span class="hamburger"></span>
			<span class="hamburger"></span>
			<span class="hamburger"></span>
		</button>
		<div class="navTitle"><b>#</b>AskJuan</div>
	</nav>
	<div class="nav-dropdown">
		<ul>
			<li>Your Name</li>
			<li>Logout</li>
		</ul>
	</div>

	<div class="custom-container">
		<?php
			$stmt = $conn->prepare("SELECT * FROM category");
			$stmt->execute();
			$stmt->bind_result($id, $name);
			while($stmt->fetch()) {
		?>
		<div class="color-box" style="background-color: #FC6E51" data-link="?category=<?php echo $id?>">
			<i class="fas fa-sticky-note categ-logo"></i>
			<div class="categ-title"><?php echo $name ?></div>
		</div>
		<?php } ?>
	</div>
	<?php
		}
	?>
 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript">
		$('.color-box').on("click", function() {
			var link = $(this).data("link");
			$(".custom-container").slideUp();
			setTimeout(function(){
				$(location).attr('href',link);
			}, 500);
		});

		$('.toggle').on("click", function() {
			$('.nav-dropdown').slideToggle();
		});
	</script>
</body>
</html>
