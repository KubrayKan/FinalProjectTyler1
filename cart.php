<?php

include 'shopItems.php';
include 'CartItem.php';


  $shopItems = new ShopItems();

  $data = array();

  $noStock = false;

  if(isset($_GET["nostock"])){
    $noStock = true;
  }

  if(isset($_COOKIE["cart"])){
    $cart = json_decode($_COOKIE["cart"]);
    if(empty($cart)){
      setcookie("cart", "", time()-60, "/", "", 0);
      header("Location: cart.php");
      exit();
    }
    foreach($cart as $value){
        $data[] = new CartItem($value->id, $value->quantity);
    }
  }

  if(!empty($_GET["action"])){
    switch($_GET["action"]) {
      case "delete":
        $toBeDeleted = new CartItem($_GET["id"], $_GET["quantity"]);
        if($data[array_search($toBeDeleted, $data)]->quantity == 1){
          array_splice($data, array_search($toBeDeleted, $data), 1);      
        }
        else{
          $data[array_search($toBeDeleted, $data)]->decrease_quantity();
        }
        setcookie("cart", json_encode($data), time()+3600, "/", "", 0);
        header("Location: cart.php");
        exit();
      break;
      case "deleteAll":
        $toBeDeleted = new CartItem($_GET["id"], $_GET["quantity"]);
        array_splice($data, array_search($toBeDeleted, $data), 1);
        setcookie("cart", json_encode($data), time()+3600, "/", "", 0);
        header("Location: cart.php");
        exit();
      break;
      case "empty":
        setcookie("cart", "", time()-60, "/", "", 0);
        header("Location: cart.php");
        exit();
      break;
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Cart | loltyler1</title>
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
  document.getElementById("cartNav").classList.add('active');
  document.getElementById("homeNav").classList.remove('active');
  </script>
  
<div class="jumbotron text-center" id="topCard">
    <img src="https://assets.bigcartel.com/theme_images/51543572/t3.png?auto=format&amp;fit=max&amp;h=250&amp;w=1300" alt="Loltyler1.com Home" style="margin-top:100px;"> 
</div>

<div style="background-color:#6d6d70; height:1px;"></div><br>

<div class="container">
 
  <div class="row">
    <div class="col-sm-6 col-md-7 col-lg-8">
      <h2>Your Cart</h2>
    </div>
    <div class="col-sm-5 col-md-5 col-lg-4">
      <a href="orderSummary.php" class="btn btn-primary submitButton" style="float:right;">Order Summary</a>
    </div>
  </div>
  <?php if($noStock){
    $noStockItem = $shopItems->displayShopItemById($_GET['nostock']);
    ?>
    <p style="color:red;">Sorry. We do not have enough <?php echo $noStockItem['name'];?> to satisfy your transaction. Current quantity on hand: <?php echo $noStockItem['quantity_on_hand'];?></br>Please modify your cart so that your purchase doesn't go over our inventory's quantities</p>
  <?php } ?>

  <?php
    if(isset($_COOKIE["cart"])){
      
  ?>
  <table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Individual Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total Price</th>
      <th scope="col">Remove one</th>
      <th scope="col">Remove All</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach($data as $value){
        $item = $shopItems->displayShopItemById($value->id);
        ?>
        <tr>
          <td><?php echo '<img src="data:image/png;base64,'.base64_encode($item['image']).'" alt="'.$item['name'].'" style="width:50%"/>'?></td>
          <td><?php echo $item['name'] ?></td>
          <td><?php echo $item['description'] ?></td>
          <td><?php echo "$ ".number_format($item['price'], 2);?></td>
          <td><?php echo $value->quantity ?></td>
          <td style="width:10%;"><?php echo "$ ".number_format($item['price']*$value->quantity, 2);?></td>
          <td><a style="color:white;" href="cart.php?action=delete&id=<?php echo $item["id"]; ?>&quantity=<?php echo $value->quantity ?>" class="btnRemoveAction"><i class="fa fa-trash" aria-hidden="true">x1</i></a></td>
          <td><a style="color:black;" href="cart.php?action=deleteAll&id=<?php echo $item["id"]; ?>&quantity=<?php echo $value->quantity ?>" class="btnRemoveAction"><i class="fa fa-trash" aria-hidden="true">x<?php echo $value->quantity ?></i></a></td>
        </tr><?php
      }
    }
    else{
      ?>
      <h2 class="text-center" style="margin-bottom:30px;">Your Cart is Empty</h2>
      <?php
    }
    
    ?>
  </tbody>
</table>


  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>