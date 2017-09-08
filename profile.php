<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
}else{
  $_SESSION['login'] = True;
}
 // select logged-in users detail
 $res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<style>
  .imgrow{
    margin-top: 5vh;
  }
  .imgrow img{
    border:2px solid #cb2356;
  }
  .container{
    background-color: rgba(226, 61, 128,0.2);
  }
  @import url('https://fonts.googleapis.com/css?family=Raleway');
    h1{
      font-family: 'Raleway', sans-serif;
      font-size:15pt;
    }










</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
          <?php
          var_dump($_GET);
          $name = $_POST["id"];
          echo $name;
          ?>
          <?php
          if(isset($_SESSION['category'])){
            $sqlstatement = "SELECT * FROM users WHERE userId="."\"".$name."\"";
            $photos = mysqli_query($conn,$sqlstatement);
            $linkArray = Array();
            $counter = 0;
            $row = mysqli_fetch_array($photos, MYSQLI_NUM);
            while ($row != NULL){
              echo "<div class=\"row imgrow\">";
                echo "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\">";
                echo "<p>";
                  echo $row[1];
                echo "</p>";
                echo "<p>";
                  echo $row[2];
                echo "</p>";
                echo "<p>";
                  echo "<img class=\"img-responsive\" src=\"".$row[5] ."\">";
                echo "</p>";
              echo "</div>";
              $linkArray[$counter] = $row[0];
              $counter += 1;
              $row = mysqli_fetch_array($photos, MYSQLI_NUM);
            }
            echo "</div>";
          }
          ?>

          <a href="userList.php">Back to userlist</a>
</body>
</html>
<?php ob_end_flush(); ?>
