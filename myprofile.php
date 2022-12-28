<?php

@include 'config.php';
session_start(); {
// Select the image from the database
$user_name = $_SESSION['user_name'];

$imagee="SELECT image_name from profile_image WHERE name='$user_name' ORDER BY created_at DESC";
$imagequery=mysqli_query($conn, $imagee);
$rowimage=mysqli_fetch_assoc($imagequery);
// $image = $imagequery->fetch_assoc();
// $sqll = "SELECT user_form.name, image.image_name FROM user_form INNER JOIN image ON user_form.Id = image.u_id WHERE user_form.name='$user_name';";
if(isset($_FILES['imagee'])){
	echo "<pre>";
	print_r($_FILES);
	echo "</pre>";

	$file_name=$_FILES['imagee']['name'];
	$file_size=$_FILES['imagee']['size'];
	$file_tmp=$_FILES['imagee']['tmp_name'];
	$file_type=$_FILES['imagee']['type'];

	if(move_uploaded_file($file_tmp, "assets/Profile_image/". $file_name)){
		// echo "Successfull.";

	}else{
		echo"Could not be uploaded.";
	}

}


if(isset($_POST['submit'])){
	$user_image =($_POST['imagee']);
    if(empty($file_name)) {
        // the input field is empty
        echo "Please enter a value in the input field.";
    }
	// $image = ($_POST[$file_name]);
	// Attempt insert query execution
	$sqlii = "INSERT INTO profile_image(name, image_name) VALUES ('$user_name','$file_name')";

	if(mysqli_query($conn, $sqlii)){
		header('location:myprofile.php');
		// echo "Records added successfully.";
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
}
// $result = $conn->query($sqll);
// $uimage="SELECT image_name from image WHERE u_id=user_form.Id ORDER BY created_at DESC";

	// Query the database to retrieve the text value

	$Bio = "SELECT bio FROM user_bio WHERE name = '$user_name' ORDER BY created_at DESC ";
	$bio_result = mysqli_query($conn, $Bio);
	$bio_row = mysqli_fetch_assoc($bio_result);
	// $bio_text= $bio_row['bio']
// Array ( [name] => Nikesh Uprety [image_name] => /assets/img/smallphoto.jpg )
// Fetch and display the titles
// $query = "SELECT * FROM user_blogs WHERE name = '$user_name' ORDER BY created_at DESC";
// Check for errors
// if(!$result){
//     die('Error retrieving image from database [' . $conn->error . ']');
// }
// Get the image data as an associative array
// echo($image['image_name']);
};
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="assets/img/favicon.ico">
        <title>BlogsNepal</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Fonts -->
        <link
            href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
            rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="assets/css/mediumish.css" rel="stylesheet">
    </head>

    <body>

        <!-- Begin Nav ================================================== -->
<?php
@include_once 'components/navbar.php';
?>
        <!-- End Nav ================================================== -->

        <!-- Begin Top Author Page ==================================================
        -->
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="mainheading">
                        <div class="row post-top-meta authorpage">
                            <div class="col-md-10 col-xs-12">
                                <h1><?php echo $_SESSION['user_name'] ?></h1>
                                <span class="author-description">

                                    <div class="input-group mb-3">
                                        <?php

												// Check if the text value exists in the database
												
												if ($bio_result->num_rows !== 0) {
												  // If the text value exists, display it instead of the form field
												  $bio_text=$bio_row['bio'];
												  echo $bio_text;
                                                  ?>
                                                    <a href="bioo.php" class="btn follow">Edit Bio</a>
                                        <?php
                                                
                                                } 
                                                else {
												  // If the text value does not exist, display the form field
													?>
                                        <div class="input-group-append">
                                            <form action="bioo.php">
                                                <button class="btn btn-outline-secondary" name="submit">CLick here to add bio</button>
                                            </form>
                                        </div>
                                        <?php
												}
												?>
                                    </div>
                                </span>
                                <div class="sociallinks">
                                    <a target="_blank" href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>

                                    <a target="_blank" href="#">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <?php
if ($imagequery->num_rows !== 0) {
    // If the text value exists, display it instead of the form field
?>
                            <div class="col-md-2 col-xs-12">
                                <img
                                    class="img-size"
                                    src="http://localhost/blogsnepal/assets/Profile_image/<?php echo $rowimage['image_name']?>"
                                    ;=";"
                                    alt=" <?php echo $_SESSION['user_name'] ?>">
                            </div>
                        <?php
} 

  else {
    // If the text value does not exist, display the form field
      ?>
                            <div class="input-group-append">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <label>
                                        <img 
                                            class="img-size immg"
                                            src="assets/img/ilogo.png"
                                            style="position:fixed;cursor:pointer;">
                                        <input required type="file" name="imagee" style="display:none">
                                    </label>
                                    <button
                                        type="submit"
                                        name="submit"
                                        value="submit"
                                        class="btn btn-success immg"
                                        style="box-sizing: border-box;margin-top: 149px;position: absolute;margin-left: 60px;">Submit</button>
                                </form>
                            </div>
                            <?php
  }
  ?>
                        </div>
                        <?php
?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Top Author Meta ================================================== -->
    <div class="section-title" id="rect" style="text-align:center;">
        <h2>
            <span>Recently Uploaded</span></h2>
    </div>
    <?php
$query= "SELECT * FROM user_blogs WHERE name = '$user_name' ORDER BY created_at DESC";
$rest = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($rest)) {
	
?>
    <div class="graybg authorpage">
        <div class="container">
            <div class="listrecent listrelated">

<!-- begin post -->
                <div class="authorpostbox">
                    <div class="card">
                        <a href="myprofile.php">
                            <img
                                class="img-fluid img-thumb"
                                src="http://localhost/blogsnepal/assets/blogs_images/<?=$row['images']?>"
                                alt="This blog image is Currently Unavailable">
                        </a>
                        <div class="card-block">
                            <h2 class="card-title">
                                <a href="post.html">
                                    <?php echo $row['title']; ?>
                                </a>
                            </h2>
                            <h4 class="card-text">This is a longer card with supporting text below as a
                                natural lead-in to additional content. This content is a little bit longer.</h4>
                            <div class="metafooter">
                                <div class="wrapfooter">
                                    <span class="meta-footer-thumb">
                                        <a href="myprofile.php"><img
                                            class="author-thumb"
                                            src="http://localhost/blogsnepal/assets/Profile_image/<?php echo $rowimage['image_name']?>"
                                            ;=";"
                                            alt="<?php echo $_SESSION['user_name'] ?>"></a>
                                    </span>
                                    <span class="author-meta">
                                        <span class="post-name">
                                            <a href="myprofile.php"><?php echo $_SESSION['user_name'] ?></a>
                                        </span><br/>
                                        <span class="post-date"><?php echo date('F jS, Y', strtotime($row['created_at']))?></span>
                                        <span class="dot"></span><span class="post-read">6 min read</span>
                                    </span>
                                    <span class="post-read-more">
                                        <a href="post.html" title="Read Story">
                                            <svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25">
                                                <path
                                                    d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z"
                                                    fill-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
			}


?>
<!-- end post -->
                <!-- Begin Footer ================================================== -->
                <div class="container">
                    <div class="footer">
                        <p style="text-align:center;">
                            Copyright &copy; 2022 Nikesh Uprety
                        </p>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- End Footer ================================================== -->

                <!-- Bootstrap core JavaScript
                ================================================== -->
                <!-- Placed at the end of the document so the pages load faster -->
                <script src="assets/js/jquery.min.js"></script>
                <script
                    src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
                    integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
                    crossorigin="anonymous"></script>
                <script src="assets/js/bootstrap.min.js"></script>
                <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
            </body>

        </html>