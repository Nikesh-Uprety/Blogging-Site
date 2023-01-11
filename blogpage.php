<?php
@include 'config.php';
session_start(); {
if (isset($_GET['id'])){
    // Sanitize the provided item id to prevent SQL injection attacks
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    // Query the database for the item with the specified id	
$sql = "SELECT * FROM user_blogs WHERE id = $id";
$items = mysqli_query($conn, $sql);
}
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="assets/img/logo.png">
<title>Blogs Nepal</title>
<link rel="shortcut icon" href="assets/css/bootstrap.min.css">

<!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<!-- Fonts -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Righteous%7CMerriweather:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="assets/css/mediumish.css" rel="stylesheet">
<style>
	@import url('https://fonts.googleapis.com/css2?family=Khula:wght@600&display=swap');
</style>
</head>
<body>
<?php
@include_once 'components/navbar.php';
?>
<!-- Begin Article
================================================== -->
<?php
while ($feat = mysqli_fetch_array($items)) {
	$profile_name= $feat['name'];
	$imagee="SELECT * from profile_image WHERE name='$profile_name'";
	$imagequery=mysqli_query($conn, $imagee);
	$rowimage=mysqli_fetch_assoc($imagequery);

?>
<div class="container">
	<div class="row">

		<!-- Begin Fixed Left Share -->
		<div class="col-md-2 col-xs-12">
			<div class="share">
				

			</div>
		</div>
		<!-- End Fixed Left Share -->

		<!-- Begin Post -->
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<div class="mainheading">

				<!-- Begin Top Meta -->
				<div class="row post-top-meta">
					
					<div class="col-md-10">
						<a class="link-dark" href="#">Posted by '<?=$feat['name']?>'</a>
						<br>
						<span class="post-date">On <?php echo date('F jS, Y', strtotime($feat['created_at']))?></span><span class="dot"></span><span class="post-read">6 min read</span>
					</div>
				</div>
				<!-- End Top Menta -->

				<h1 class="posttitle"><?= $feat['title']?></h1>

			</div>

			<!-- Begin Featured Image -->
			<img class="featured-image img-fluid" src="http://localhost/blogsnepal/assets/blogs_images/<?=$feat['images']?>" alt="Image not available">
			<!-- End Featured Image -->

			<!-- Begin Post Content -->
			<div class="article-post" style="font-family:'Khula', sans-serif;" >
				<p >
				<?= $feat['content']?>
				</p>
			
			</div>
		</div>
	</div>
</div>
<?php
}
?>

<!-- End Article
================================================== -->


<!-- Begin Related
================================================== -->
<div class="hideshare"></div>
<div class="section-title" id="rect" style="text-align:center;">
	<h2>
		<span>Popular Contents</span></h2>
	</div>
	<div class="graybg">
		<div class="container">
			<div class="row listrecent listrelated">
				<?php
$query_list= "SELECT * FROM user_blogs ORDER BY created_at DESC LIMIT 3";
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
			<div class="col-md-4">
				<div class="card">
					<a href="#">
					<img class="img-fluid img-thumb" src="http://localhost/blogsnepal/assets/blogs_images/<?=$feat['images']?>" alt="">
					</a>
					<div class="card-block">
						<h2 class="card-title"><a href="#"><?=$feat['title']?></a></h2>
						<div class="metafooter">
							<div class="wrapfooter">
								<span class="meta-footer-thumb">
								<a href="#"><img class="author-thumb" src="http://localhost/blogsnepal/assets/Profile_image/<?=$rowimage['image_name'];?>" alt="No image available"></a>
								</span>
								<span class="author-meta">
								<span class="post-name"><a href="#"><?=$feat['name']?></a></span><br/>
								<span class="post-date">22 July 2017</span><span class="dot"></span><span class="post-read">6 min read</span>
								</span>
								<span class="post-read-more"><a href="#" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25"><path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path></svg></a></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end post -->
			<?php
}
?>

		</div>
	</div>
</div>
<!-- End Related Posts
================================================== -->



<!-- Begin Footer
================================================== -->

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
