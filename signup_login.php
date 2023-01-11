<?php
@include 'config.php'; 
// Start the session
session_start();
if(isset($_POST['login'])){
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = ($_POST['password']);
  $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
  $result = mysqli_query($conn, $select);

  if(mysqli_num_rows($result) > 0){

     $row = mysqli_fetch_array($result);


     if($row['user_type'] == 'admin'){

        $_SESSION['admin_name'] = $row['name'];
        header('location:admin_page.php');

     }elseif($row['user_type'] == 'user'){

        $_SESSION['user_name'] = $row['name'];
        header('location:home.php');

     }
    
  }else{
     $error[] = 'Incorrect Email or Password!';
  }
};
if(isset($_POST['register'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if (strlen($_POST["password"]) < 6) {

        $error[] ="Password is < 6 char";
    }
    else{

        $pass = md5($_POST['password']);
        $cpass = md5($_POST['cpassword']);
        $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
        
        $result = mysqli_query($conn, $select);
        
        if(mysqli_num_rows($result) > 0){
           
           $error[] = 'user already exist!';
           
         }else{
            
            if($pass != $cpass){
               $error[] = 'password not matched!';   }
               else{
                  $insert = "INSERT INTO user_form(name, email, password) VALUES('$name','$email','$pass')";
                  mysqli_query($conn, $insert);
                  // header('location:signup_login.php');
                  $error[] = 'You have Registered successfully';

                  
               }
            }
         }
 };
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BlogsNepal Login</title>
<link rel="shortcut icon" href="assets/css/bootstrap.min.css">


   <!-- custom css file link  -->
   <link rel="stylesheet" href="assets/css/signup_login.css">
   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
   <script src="./validation.js" defer></script>
   <link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'><link rel="stylesheet" href="assets/css/signup_login.css">
</head>
<body>
   <div class="section">
		<div class="container">
			<div class="row full-height justify-content-center">
				<div class="col-12 text-center align-self-center py-5">
					<div class="section pb-5 pt-5 pt-sm-2 text-center">
						<h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
			          	<input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
			          	<label for="reg-log"></label>
						<div class="card-3d-wrap mx-auto">
							<div class="card-3d-wrapper">
								<div class="card-front">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-4 pb-3">Log In</h4>
    <form action="" method="post" >
    <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
											<div class="form-group">
												<input type="email" name="email" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
												<i class="input-icon uil uil-at"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="password" name="password" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
                                            <input type="submit" name="login" value="login now" class="btn mt-4">
    </form>
                            				<!-- <p class="mb-0 mt-4 text-center"><a href="#0" class="link">Forgot your password?</a></p> -->
				      					</div>
			      					</div>
			      				</div>
								<div class="card-back">
									<div class="center-wrap">
										<div class="section text-center">
											<h4 class="mb-4 pb-3">Sign Up</h4>
    <form action="" method="post" id="signup">
    
											<div class="form-group">
												<input type="text" name="name" class="form-style" placeholder="Your Full Name" id="logname" autocomplete="off">
												<i class="input-icon uil uil-user"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="email" id="email" name="email" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
												<i class="input-icon uil uil-at"></i>
											</div>	
											<div class="form-group mt-2">
												<input type="password" id="password" name="password" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
											<div class="form-group mt-2">
												<input type="password" id="password_confirmation" name="cpassword" class="form-style" placeholder="Confirm Password" id="logpass" autocomplete="off">
												<i class="input-icon uil uil-lock-alt"></i>
											</div>
				
											<button name="register" type="submit" class="btn mt-4"  id="submit">Register Now</button>
    </form>
											<!-- <a href="#" class="btn mt-4">submit</a> -->
				      					</div>
			      					</div>
			      				</div>
			      			</div>
			      		</div>
			      	</div>
		      	</div>
	      	</div>
	    </div>
	</div>
   </form>

</div>
<script src="assets/js/elements.js"></script>
</body>
</html>


