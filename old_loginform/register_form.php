<?php

@include 'config.php';
error_reporting(0);

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = ($_POST['password']);
   $cpass = ($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
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
        <title>register form</title>

        <!-- custom css file link -->
        <link rel="stylesheet" href="assets/css/style.css">

    </head>
    <body>

        <div class="form-container">

            <form action="" method="post" id="customForm">
                <h3>register now</h3>
                <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
                <input
                    type="text"
                    name="name"
                    required="required"
                    placeholder="enter your name">
                <input
                    type="email"
                    name="email"
                    required="required"
                    placeholder="enter your email">
                <input
                    type="password"
                    name="password"
                    required="required"
                    placeholder="enter your password">
                <input 
                    type="password"
                    name="cpassword"
                    required="required"
                    placeholder="confirm your password">
                <select name="user_type">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
            <button name="submit" type="submit" class="form-btn"  id="submit">Register Now</button>
            <p>already have an account? <a href="login_form.php">login now</a></p>
            
    </form>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</script>
</body>
</html>