<?php
include 'accounts.php';

$accounts = new Accounts();

$previous = $_GET['previous'];
if(isset($_POST["submit"])){
  $users = $accounts->getUsername($_COOKIE["username"]);
  
    if($users != "Empty"){
      $oldPass = $_POST['oldPassword'];
      $newPass = $_POST['newPassword'];
      
      if($users['password'] == $oldPass){
          $result = $accounts->changePassword($_COOKIE["username"], $newPass);
          if($result == "good"){
            header("Location: ".$previous);
            exit();
          }
          else{
              $wrong = "Something went wrong please try again";
          }
        
      }

      else{
        $wrongPasswordMessage = "Enter the correct current password";
      }
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Change Password | Loltyler1.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
  <link rel="stylesheet" href="loltyler1.css"/>
</head>
<body>

<div class="card text-center" id="topCard">
  <h4>Change your account password</h4>
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

<div class="container">
  <form action="" method="POST">
    <div class="form-group">
      <label for="oldPasword">Current Password:</label>
      <input type="password" class="form-control" name="oldPassword" placeholder="Enter current password" required="">
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
      <label for="newPassword">Password:</label>
      <input type="password" class="form-control" name="newPassword" placeholder="Enter new password" required="">
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary submitButton" value="Submit">
        <a href="home.php" style="float:right;" >Cancel</a>
    </div>
    
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>