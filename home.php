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
            <?php echo "<div class=\"container\">";
            echo "<div class=\"row\">";
            echo "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-9\">";
            echo "<img class=\"img-responsive\" src=\"0.png"."\">";
            echo "</div>";
            echo "</div>";
            echo "<div class=\"row\">";
              echo "<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">";
              echo "<h1>" . "Hi" ." ".$userRow['userName'] ."</h1>";
              echo "</div>";
              echo "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-3\">";
              echo "<img class=\"img-responsive\" src=\"".$userRow['photolink'] ."\">";
              echo "<a href=\"logout.php?logout\">Sign Out</a>";
              echo "</div>";
              echo "</div>";
            ?>



            <?php
            if(isset($_SESSION['category'])){
              $sqlstatement = "SELECT photolink FROM Photos WHERE category="."\"".$_SESSION['category']."\"";
              $photos = mysqli_query($conn,$sqlstatement);
              $linkArray = Array();
              $counter = 0;
              $row = mysqli_fetch_array($photos, MYSQLI_NUM);
              while ($row != NULL){
                $linkArray[$counter] = $row[0];
                $counter += 1;
                $row = mysqli_fetch_array($photos, MYSQLI_NUM);
              }

              for($i=0;$i<count($linkArray);$i++){
                echo "<div class=\"row imgrow\">";
                  echo "<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">";
                    echo "<img class=\"img-responsive\"src=\"" .$linkArray[$i] . "\">";
                  echo "</div>";
                echo "</div>";
              }
              var_dump($_SESSION);
              echo "</div>";

            }



            ?>
            <a href="userList.php">userList</a>
</body>
</html>
<?php ob_end_flush(); ?>
