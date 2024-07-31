<?php

include 'shopItems.php';
include 'CartItem.php';


  $shopItems = new ShopItems();

  $data = array();

  if(isset($_COOKIE["cart"])){
    $cart = json_decode($_COOKIE["cart"]);
    foreach($cart as $value){
        $data[] = new CartItem($value->id, $value->quantity);
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Order Summary | Loltyler1.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
  <link rel="stylesheet" href="loltyler1.css"/>
</head>
<body>

<?php
  include_once('navbar.php');
?>

<script>
  document.getElementById("shopNav").classList.remove('active');
  document.getElementById("homeNav").classList.remove('active');
  document.getElementById("calendarNav").classList.remove('active');
  document.getElementById("cartNav").classList.remove('active');
  document.getElementById("orderNav").classList.remove('active');
  </script>

<div class="jumbotron text-center" id="topCard">
    <img src="https://assets.bigcartel.com/theme_images/51543572/t3.png?auto=format&amp;fit=max&amp;h=250&amp;w=1300" alt="Loltyler1.com Home" style="margin-top:100px;"> 
</div>

<div style="background-color:#6d6d70; height:1px;"></div><br>

<?php
    if(isset($_COOKIE["username"])){
        if(isset($_COOKIE["cart"])){?>
<div class="container">
    <h1 class="purple" style="margin-bottom:20px;">Your Order Summary:</h1>
    <div style="background-color:white; height:1px;"></div><br>
    <h2 class="purple" style="margin-bottom:20px;">Items to purchase:</h2>
    <?php
    $subtotal = 0.00;
    $taxes = 0.00;
    $delivery = 0.00;
    $total = 0.00;
    foreach($data as $value){
        $item = $shopItems->displayShopItemById($value->id);
        $subtotal = $subtotal + $item['price']*$value->quantity;
    ?>
    <p style="margin-bottom:0px;"><?php echo $item['name'];?>&nbsp;&nbsp;&nbsp;<?php echo "$ ".number_format($item['price']*$value->quantity, 2);?></p>
    <?php
      }?>
<div style="background-color:white; height:1px; margin-top:20px;"></div><br>
<h2 class="purple">Subtotal: <?php echo "$ ".number_format($subtotal, 2);?></h2>
<h2 class="purple">Taxes: <?php $taxes = $subtotal*15/100; echo "$ ".number_format($taxes, 2);?></h2>
<h2 class="purple">Delivery: <?php $delivery = $subtotal*10/100; echo "$ ".number_format($delivery, 2);?></h2>
<p style="margin-bottom:20px;">(*Takes between 3-4 days)</p>
<div style="background-color:white; height:1px;"></div><br>
<h2 class="purple">Total: <?php $total = $subtotal+$taxes+$delivery; echo "$ ".number_format($total, 2);?></h2>
<a href="paymentInfo.php?total=<?php echo $total;?>" class="btn btn-primary submitButton" style="margin-bottom:50px;">Payment Information</a>

</div>


<?php
        }else{?>
<div class="container">
    <h1 class="purple text-center">Your Cart is empty. Add some items in order to see this page</h1>
</div><?php
        }
    }else{?>
<div class="container">
    <h1 class="text-center" style="color:white;">You must be logged in to view the information in this page</h1>
</div><?php
  }
?>  


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>