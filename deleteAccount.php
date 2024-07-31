<?php
include 'accounts.php';

$accounts = new Accounts();

$previous = $_GET['previous'];
if(isset($_POST["submit"])){
  $result = $accounts->deleteAccount($_COOKIE["username"]);
    if($result == "good"){
        setcookie("username", "", time()-60, "/", "", 0);
        setcookie("cart", "", time()-60, "/", "", 0);
        header("Location: ".$previous);
    }
    else{
        $wrong = "Something went wrong please try again";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Delete Account | Loltyler1.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
  <link rel="stylesheet" href="loltyler1.css"/>
</head>
<body>

<div class="card text-center" id="topCard">
  <h4>Delete your Account</h4>
  <?php 
        if(isset($wrong)){
          if($wrong != "")
          {
            ?> <p style="color:red;"><?php echo $wrong?></p> <?php
          }
        }
      ?>
</div>

<div style="background-color:#6d6d70; height:1px;"></div><br>

<div class="container" style="width:25%;">
  <form action="" method="POST">
        <input type="submit" name="submit" class="btn btn-primary submitButton" value="Yes">
        <a href="<?php echo $previous;?>" class="btn btn-primary submitButton" style="float:right;" >Cancel</a>
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>