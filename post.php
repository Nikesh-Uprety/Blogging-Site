<?php

@include 'config.php';

session_start();{
$user_name = $_SESSION['user_name'];
if(isset($_FILES['image'])){
	// echo "<pre>";
	// print_r($_FILES);
	// echo "</pre>";

	$file_name=$_FILES['image']['name'];
	$file_size=$_FILES['image']['size'];
	$file_tmp=$_FILES['image']['tmp_name'];
	$file_type=$_FILES['image']['type'];

	if(move_uploaded_file($file_tmp, "assets/blogs_images/". $file_name)){
		// echo "Successfull.";

	}else{
		// echo"Could not be uploaded.";
	}

}

if(isset($_POST['submit'])){
	$title =($_POST['title']);
	$cont = ($_POST["content"]);
	// $image = ($_POST[$file_name]);
	// Attempt insert query execution
	$sql = "INSERT INTO user_blogs(name, title, `content`, images) VALUES ('$user_name','$title', '$cont' ,'$file_name')";
	if(mysqli_query($conn, $sql)){
		header('location:home.php');
		// echo "Records added successfully.";
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
	
}

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" href="assets/img/favicon.ico">
<title>blogsnepal</title>
<link rel="shortcut icon" href="assets/img/logo.png">

<!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<!-- Fonts -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Righteous%7CMerriweather:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="assets/css/mediumish.css" rel="stylesheet">
<style>

@media (max-width: 600px) {
  .form-outline {
	margin-top:40px;
    width: 100%;
  }
  .form-label {
	font-weight: bold;

    display: block;
    margin-bottom: 0.5rem;
  }
  .form-control {
    width: 100%;
  }
}
@media (min-width: 601px) {
	.center button {
    margin-top: 31px;
    margin-right: 140px;
}
	input#typeText {
    margin-bottom: 13px;
}
  .form-outline {
    max-width: 600px;
	margin-top:40px;
  }
  .form-label {
	font-weight: bold;
    display: inline-block;
    width: 22%;
    margin-right: 1%;
  }
  .form-control {
    display: inline-block;
    width: 78%;
  }
}

</style>
</head>
<body>

<!-- Begin Nav
================================================== -->
<nav class="navbar navbar-toggleable-md navbar-light bg-white fixed-top mediumnavigation">
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="container">
	<!-- Begin Logo -->
	<a class="navbar-brand" href="home.php">
	<img src="assets/img/logo.png" alt="logo">
	</a>
	<!-- End Logo -->
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<!-- Begin Menu -->
		<ul class="navbar-nav ml-auto">
		<li class="nav-item active">
			<a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
			<a class="nav-link" href="post.php">Post</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" href="myprofile.php">My profile</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="myprofile.php">
					<?php echo $_SESSION['user_name'] ?>
				</a>
			</li>
			<li class="nav-item">
			<a class="nav-link" href="logout.php">Logout</a>
			</li>
		</ul>
		<!-- End Menu -->
		<!-- Begin Search -->
		<form class="form-inline my-2 my-lg-0">
			<input class="form-control mr-sm-2" type="text" placeholder="Search">
			<span class="search-icon"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25"><path d="M20.067 18.933l-4.157-4.157a6 6 0 1 0-.884.884l4.157 4.157a.624.624 0 1 0 .884-.884zM6.5 11c0-2.62 2.13-4.75 4.75-4.75S16 8.38 16 11s-2.13 4.75-4.75 4.75S6.5 13.62 6.5 11z"></path></svg></span>
		</form>
		<!-- End Search -->
	</div>
</div>
</nav>
<div class="center">
	<form action="" method="post" id="customForm" enctype="multipart/form-data">
	<div class="form-outline">
	
		<label  class="form-label" for="typeText">Title</label>
	<input name="title" type="text" id="typeText" class="form-control" />
	<!-- </div>
		<div class="form-outline"> -->

		<label class="form-label" for="textAreaExample">Content</label>
	<textarea name="content" class="form-control" id="textAreaExample" rows="10"></textarea>
	<label class="form-label" for="customFile">Input Image</label>
	<input type="file" name="image" class="form-control filee" id="customFile" />
	<button type="submit" name="submit" value="submit" class="btn btn-success pull-right">Post</button>
	</div>
</form>
</div>

<!-- End Nav
================================================== -->

<!-- Begin Footer
================================================== -->
<div class="container">
	<div class="footer">
	<p style="text-align:center;">
			 Copyright &copy; 2022 Nikesh Uprety
		</p>
		<div class="clearfix">
		</div>
	</div>
</div>
<!-- End Footer
================================================== -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
<script src="assets/js/mediumish.js"></script>
</body>
</html>
