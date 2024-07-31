<?php
include 'accounts.php';

$accounts = new Accounts();
$previous = $_GET['previous'];

if(isset($_POST["submit"])){
    
  $result = $accounts->createAccount($_POST);
  
  if($result == "good"){
    $username = $_POST['username'];
    $email = $_POST['email'];
    setcookie("username", $username, time()+3600, "/", "", 0);
    $to_email = $email;
    $subject = 'Account Created Succesfully';
    $message = "Thank you for creating an account with us ".$username." you are so alfa it's insane";
    $headers = 'From: noreply@loltyler1.com';
    mail($to_email,$subject,$message,$headers);

    header("Location: ".$previous);
    exit();
  }
  else if($result == "bad"){
    echo "<script type='text/javascript'>alert('Something went wrong please try again');</script>";
  }    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Create Account | Loltyler1.com</title>
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
    </div>
    <div class="form-group">
      <label for="email">Email address:</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email" required="">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter password" required="">
    </div>
    <div class="form-group">
      <label for="city">City:</label>
      <input type="text" class="form-control" name="city" placeholder="Enter city" required="">
    </div>
    <div class="form-group">
      <label for="province">Province/state:</label>
      <input type="text" class="form-control" name="province" placeholder="Enter province or state" required="">
    </div>
    <div class="form-group">
      <label for="country">Country:</label>
      <input type="text" class="form-control" name="country" placeholder="Enter Country" required="">
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary submitButton" value="Create Account">
        <a href="loginAccount.php?previous=<?php echo $previous;?>" style="float:right;" >Log In</a>
    </div>
    
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>