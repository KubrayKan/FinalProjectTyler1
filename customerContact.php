<?php
include 'accounts.php';
include 'tickets.php';

$tickets = new Ticket();
$accounts = new Accounts();

if(isset($_POST["submit"])){
    
  $username = $_COOKIE["username"];
  $user = $accounts->getUsername($_COOKIE["username"]);
  $ticketSubject = $_POST["subject"];
  $ticketBody = $_POST["body"];

  $result = $tickets->ticket($username, $ticketSubject, $ticketBody);
  
  $to_email = $user['email'];
  $orderNumber = rand(10,100);
  $subject = 'LolTyler1 Ticket #'.$orderNumber;
  $message = "Thank you for contacting us ".$username."\nTicket Details:\nSubject: ".$ticketSubject."\nBody: ".$ticketBody;
  $headers = 'From: noreply@loltyler1.com';
  mail($to_email,$subject,$message,$headers);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Contact Us | Loltyler1.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
  <link rel="stylesheet" href="loltyler1.css"/>
</head>
<body>

<?php
  include_once('navbar.php');
?>

<script>
  document.getElementById("customerContactNav").classList.add('active');
  document.getElementById("homeNav").classList.remove('active');
  </script>

<div class="card text-center" id="topCard">
  <h4>You have an issue? Contact Us</h4>
</div>

<div style="background-color:#6d6d70; height:1px;"></div><br>

<?php if(isset($_COOKIE["username"])){?>
    <div class="container">
  <form action="" method="POST">
    <div class="form-group">
      <label for="subject">Subject:</label>
      <input type="text" class="form-control" name="subject" placeholder="Enter subject" required="">
    </div>
    <div class="form-group">
      <label for="body">Body:</label>
      <textarea class="form-control" name="body" rows="12" cols="50" placeholder="Explain your issue" required=""></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary submitButton" value="Submit">
        <a href="home.php" style="float:right;" >Cancel</a>
    </div>
    
  </form>
</div>

<?php }else{?>
    <h1 class="text-center" style="color:white;">You must be logged in to view the information in this page</h1>
<?php }?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>