<?php
include 'accounts.php';

$accounts = new Accounts();

$previous = $_GET['previous'];
if(isset($_POST["submit"])){
  $users = $accounts->getUsername($_POST['username']);
  
    if($users != "Empty"){
      $pass = $_POST['password'];
      
      if($users['password'] == $pass){
        setcookie("username", $_POST['username'], time()+3600, "/", "", 0);
        header("Location: ".$previous);
        exit();
      }

      else{
        $wrongPasswordMessage = "Password doesn't match";
      }
    }
    else{
      $wrongUsernameMessage = "Username doesn't exist";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Log In | Loltyler1.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
  <link rel="stylesheet" href="loltyler1.css"/>
</head>
<body>

<div class="card text-center" id="topCard">
  <h4>Welcome to Loltyler1.com</h4>
  <h5>Create an account or log into you existing account</h5>
</div>

<div style="background-color:#6d6d70; height:1px;"></div><br>

<div class="container">
  <form action="" method="POST">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" name="username" placeholder="Enter username" required="">
      <?php 
        if(isset($wrongUsernameMessage)){
          if($wrongUsernameMessage != "")
          {
            ?> <p style="color:red;"><?php echo $wrongUsernameMessage?></p> <?php
          }
        }
      ?>
    </div>
    
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password" required="">
      <?php 
        if(isset($wrongPasswordMessage)){
          if($wrongPasswordMessage != "")
          {
            ?> <p style="color:red;"><?php echo $wrongPasswordMessage?></p> <?php
          }
        }
      ?>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary submitButton" value="Sign In">
        <a href="createAccount.php?previous=<?php echo $previous;?>" style="float:right;" >Create Account</a>
    </div>
    
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>