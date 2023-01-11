
<?php

@include 'config.php';

session_start();
$user_name = $_SESSION['user_name'];
$imagee="SELECT image_name from profile_image WHERE name='$user_name'";
$imagequery=mysqli_query($conn, $imagee);
$rowimage=mysqli_fetch_assoc($imagequery);
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
		<h2><span>Featured</span></h2>
	</div>
	<div class="card-columns listfeaturedtag">
	<?php
$query_list= "SELECT * FROM user_blogs ORDER BY created_at DESC LIMIT 8";
$items = mysqli_query($conn, $query_list);
// $img = "SELECT images FROM user_blogs WHERE name = '$user_name'";
// $resut = mysqli_query($conn, $img);
// $image = $items->fetch_assoc();

while ($feat = mysqli_fetch_array($items)) {
	$profile_name= $feat['name'];
	$imagee="SELECT * from profile_image WHERE name='$profile_name'";
	$imagequery=mysqli_query($conn, $imagee);
	$rowimage=mysqli_fetch_assoc($imagequery);
	

?>
		<!-- begin post -->
		<div class="card">
			<div class="row">
				<div class="col-md-5 wrapthumbnail">
					<a href="blogpage.php?id=<?=$feat['Id']?>">
						<div class="thumbnail" style="background-image:url(http://localhost/blogsnepal/assets/blogs_images/<?=$feat['images']?>);">
				</div>
						
					</a>
				</div>
				<div class="col-md-7">
					<div class="card-block">
						<h2 class="card-title"><a href='blogpage.php?id=<?=$feat['Id']?>'><?=$feat['title']?></a></h2>
						<h4 class="card-text text-truncate"><?= $feat['content']?></h4>
						<div class="metafooter">
							<div class="wrapfooter">
								<span class="meta-footer-thumb">
								<a href="#"><img class="author-thumb" src="http://localhost/blogsnepal/assets/Profile_image/<?=$rowimage['image_name'];?>" alt="<?=$feat['name']?>"></a>
								</span>
								<span class="author-meta">
								<span class="post-name"><a href="#"><?= $feat['name']?></a></span><br/>
								<span class="post-date"><?php echo date('F jS, Y', strtotime($feat['created_at']))?></span><span class="dot"></span><span class="post-read">6 min read</span>
								</span>
								<span class="post-read-more"><a href="blogpage.php" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25"><path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path></svg></a></span>
							</div>
						</div>
					</div>
				</div>
			</div>
</div>
	<?php
}
	?>	

	<!-- Begin Footer
	================================================== -->
	<!-- <div class="container">
                    <div class="footer">
                        <p style="text-align:center;">
                            Copyright &copy; 2022 Nikesh Uprety
                        </p>
                        <div class="clearfix"></div>
                    </div>
                </div> -->
	<!-- End Footer
	================================================== -->

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
