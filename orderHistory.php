<?php

include 'orders.php';

$orderObject = new Orders();

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Order History | loltyler1</title>
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
document.getElementById("homeNav").classList.remove('active');
document.getElementById("orderNav").classList.add('active');
  </script>
  
<div class="jumbotron text-center" id="topCard">
    <img src="https://assets.bigcartel.com/theme_images/51543572/t3.png?auto=format&amp;fit=max&amp;h=250&amp;w=1300" alt="Loltyler1.com Home" style="margin-top:100px;"> 
</div>

<div style="background-color:#6d6d70; height:1px;"></div><br>

<div class="container">
<?php 
if(!isset($_COOKIE["username"])){?>
  <h1 class="text-center" style="color:white;">You must be logged in to view the information in this page</h1><?php
}

?>

<?php
if(isset($_COOKIE["username"])){
  $userOrders = $orderObject->search($_COOKIE["username"]);
  if(is_null($userOrders)){
    ?>
      <h1 class="purple text-center">You have not made any orders yet. What are you waiting for?</h1>
    <?php
  }else{?>
  <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Items</th>
      <th scope="col">Order Total</th>
      <th scope="col">Purchase Date</th>
      <th scope="col">Address</th>
    </tr>
  </thead>
  <tbody><?php
    foreach($userOrders as $order){
      ?>
      <tr>
          <td><?php echo $order['items'] ?></td>
          <td><?php echo "$ ".number_format($order['orderTotal'], 2);?></td>
          <td><?php echo $order['purchaseDate'] ?></td>
          <td><?php echo $order['address'] ?></td>
      </tr><?php
    }
    
  }
}


?>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>