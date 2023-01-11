
<?php

@include 'config.php';

session_start();
$user_name = $_SESSION['user_name'];
if(isset($_POST['submit'])){
	$bio =($_POST['bio']);
	// $image = ($_POST[$file_name]);
	// Attempt insert query execution
	$sql = "INSERT INTO user_bio(bio,name) VALUES ('$bio','$user_name')";
	if(mysqli_query($conn, $sql)){
		header('location:myprofile.php');
		// echo "Records added successfully.";
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>blogs.nepal</title>
<link rel="shortcut icon" href="assets/img/logo.png">
<!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<!-- Fonts -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="assets/css/mediumish.css" rel="stylesheet">
</head>
<body>

<!-- Begin Nav
================================================== -->
<?php
@include_once 'components/navbar.php';
?>
<!-- End Nav
================================================== -->

<div class="container">
<section class="featured-posts">
	<div class="section-title">
		<h2><span>Please add a bio as you wish</span></h2>
	</div>
    <form action="" method="post">
                                        <div class="input-group mb-3" >
										<textarea name="bio" aria-label="Recipient's username" aria-describedby="basic-addon2" placeholder="Add a bio" class="form-control" id="textAreaExample" rows="3" 
										style="width:401px;"></textarea>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" 
												name="submit" value="submit"type="submit">Submit</button>
</form>
</div>

<!-- /.container -->

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
