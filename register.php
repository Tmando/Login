<?php
 ob_start();
 session_start(); // start a new session or continues the previous
 if( isset($_SESSION['user'])!="" || isset($_SESSION['login'])){
  header("Location: home.php"); // redirects to home.php
 }
 include_once 'dbconnect.php';
 $error = false;
 if ( isset($_POST['btn-signup']) ) {

  // sanitize user input to prevent sql injection
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);  // remove whitespace
  $pass = strip_tags($pass); // remove html and php tags
  $pass = htmlspecialchars($pass); // special characters to html code
  $photolink = $_POST['photoLink'];
  $category = $_POST['category'];

  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }

  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check whether the email exist or not
   $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
   $result = mysqli_query($conn, $query);
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }

  if (empty($photolink)){
   $error = true;
   $photoError = "Please enter link.";
  }

  // password encrypt using SHA256();
  $password = hash('sha256', $pass);

  // if there's no error, continue to signup
  if( !$error ) {

   $query = "INSERT INTO users(userName,userEmail,userPass,category,photolink) VALUES('$name','$email','$password','$category','$photolink')";
   $res = mysqli_query($conn, $query);

   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later...";
   }

  }


 }
?>
<!DOCTYPE html>
<html>
<head>
<title>Login & Registration System</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">


             <h2>Sign Up.</h2>
             <hr />

            <?php

   //old code error

   if(isset($errMSG)){
     echo "<div class=\"alert\">";
     echo $errMSG;
     echo "</div>";
   }
   ?>




             <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />

                <span class="text-danger"><?php echo $nameError; ?></span>




             <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />

                <span class="text-danger"><?php echo $emailError; ?></span>
                <select name="category">
                        <option value="free">Free</option>
                        <option value="premium">Premium</option>
                </select>





             <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />

                <span class="text-danger"><?php echo $passError; ?></span>

             <hr />

             <input type="text" name="photoLink" class="form-control" placeholder="Enter Photolink" />

                <span class="text-danger"><?php echo $photolink; ?></span>

             <hr />


             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
             <hr />

             <a href="index.php">Sign in Here...</a>


    </form>
</body>
</html>
<?php ob_end_flush(); ?>
