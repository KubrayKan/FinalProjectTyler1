<?php

include 'shopItems.php';
include 'CartItem.php';
include 'orders.php';
include 'accounts.php';

$accounts = new Accounts();

$shopItems = new ShopItems();
$orderObject = new Orders();

$data = array();

if(isset($_COOKIE["cart"])){
    $cart = json_decode($_COOKIE["cart"]);
    foreach($cart as $value){
        $data[] = new CartItem($value->id, $value->quantity);
    }
}

$username = $_COOKIE["username"];
$user = $accounts->getUsername($_COOKIE["username"]);
$items = "";
$counter = 0;
$orderTotal = $_GET["total"];
$purchaseDate = date("Y/m/d");

foreach($data as $value){
    $item = $shopItems->displayShopItemById($value->id);
    if($counter == 0){
        $items = $items.$item['name'];
        ++$counter;
    }
    else{
        $items = $items.", ".$item['name'];
    }
}
if(isset($_POST["submit"])){
    $nameHolder = $_POST['name'];
    $cardNumber = $_POST['number'];
    $expirationDate = $_POST['expiration'];
    $securityNumber = $_POST['security'];
    $address = $_POST['address'];
    
    foreach($data as $value){
      $item = $shopItems->displayShopItemById($value->id);
      if($item['quantity_on_hand'] < $value->quantity){
        header("Location: cart.php?nostock=".$value->id);
        exit();
      }
      $oldQuantity = $item['quantity_on_hand'];
      $newQuantity = $oldQuantity-($value->quantity);
      $shopItems->changeQuantity($value->id, $newQuantity);
    }
    
    $result = $orderObject->placeOrder($username, $items, $orderTotal, $purchaseDate, $nameHolder, $cardNumber, $expirationDate, $securityNumber, $address);
    if($result == "bad"){
        header("Location: paymentInfo.php?total=".$orderTotal."&result=bad");
        exit();
    }
    else{
        $to_email = $user['email'];
        $orderNumber = rand(10,100);
        $subject = 'LolTyler1 Order #'.$orderNumber;
        $message = "Thank you for your purchase ".$username."\nOrder Details:\nItems: ".$items."\nTotal: ".$orderTotal."\nDate: ".$purchaseDate;
        $headers = 'From: noreply@loltyler1.com';
        mail($to_email,$subject,$message,$headers);

        setcookie("cart", "", time()-60, "/", "", 0);
        header("Location: home.php");
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Payment Information | Loltyler1.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
  <link rel="stylesheet" href="loltyler1.css"/>
</head>
<body>

<div class="card text-center" id="topCard">
  <h4>Loltyler1.com</h4>
  <h5>Payment Information</h5>
</div>

<div style="background-color:#6d6d70; height:1px;"></div><br>

<?php 
  if(isset($_GET['result']))
        {
            ?> <p style="color:red;">Something went wrong. Please try again or remake your order</p> <?php
        }
?>

<div class="container">
  <form action="" method="POST">
    <div class="form-group">
      <label for="name">Card Holder Name:</label>
      <input type="text" class="form-control" name="name" placeholder="Enter Name" required="">
    </div>
    
    <div class="form-group">
      <label for="number">Credit Card Number:</label>
      <input type="text" class="form-control" name="number" placeholder="Enter Credit Card Number" required="">
    </div>
    <div class="form-group">
      <label for="expiration">Expiration Date:</label>
      <input type="text" class="form-control" name="expiration" placeholder="Enter Expiration Date in format mm/yy" required="">
    </div>
    
    <div class="form-group">
      <label for="security">Security Number:</label>
      <input type="text" class="form-control" name="security" placeholder="Enter Security Number" required="">
    </div>

    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" class="form-control" name="address" placeholder="Enter the delivery address" required="">
    </div>
    
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary submitButton" value="Place Order">
        <a href="cart.php" class="btn btn-primary submitButton" style="float:right;">Cancel Order</a>
    </div>
    
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>