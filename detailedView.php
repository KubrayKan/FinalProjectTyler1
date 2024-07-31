<?php
  
  // Include database file
  include 'shopItems.php';
  include 'CartItem.php';

  $shopItems = new ShopItems();

  $limit = false;

  if(isset($_GET['item']) && !empty($_GET['item'])) {
    $itemId = $_GET['item'];
    $shopItem = $shopItems->displayShopItemById($itemId);
    if(isset($_COOKIE["cart"])){
      $cart = array();
      $data = array();
      $cart = json_decode($_COOKIE["cart"]);
      $cartItem = new CartItem($shopItem['id'], 1);
      foreach($cart as $value){
        $data[] = new CartItem($value->id, $value->quantity);
      }
      
      foreach($data as $value){
        if($value->equals($cartItem)){
          if($shopItem['quantity_on_hand'] == $value->quantity){
            $limit = true;
          }
        }
      }

    }
  }

  if(isset($_GET['cart'])) {
    $cart = array();
    if(isset($_COOKIE["cart"])){
      $data = array();
      
      $cart = json_decode($_COOKIE["cart"]);
      $cartItem = new CartItem($shopItem['id'], 1);
      
      foreach($cart as $value){
        $data[] = new CartItem($value->id, $value->quantity);
      }

      $isIn = false;
      foreach($data as $value){
        if($value->equals($cartItem)){
          $value->increase_quantity();
          $isIn = true;
        }
      }
      if(!$isIn){
        $data[] = $cartItem;
      }

      setcookie("cart", json_encode($data), time()+3600, "/", "", 0);
      header("Location: detailedView.php?item=".$shopItem['id']);
      exit();
    }
    else{
      $cartItem = new CartItem($shopItem['id'], 1);
      $cart[] = $cartItem;
      setcookie("cart", json_encode($cart), time()+3600, "/", "", 0);
      header("Location: detailedView.php?item=".$shopItem['id']);
      exit();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
      <title><?php echo $shopItem['name'] ?> | Loltyler1.com</title>
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
  document.getElementById("shopNav").classList.add('active');
  document.getElementById("homeNav").classList.remove('active');
  </script>
    
    <div class="jumbotron text-center" id="topCard">
    <img src="https://assets.bigcartel.com/theme_images/51543572/t3.png?auto=format&amp;fit=max&amp;h=250&amp;w=1300" alt="Loltyler1.com Home" style="margin-top:100px;"> </div>

    <div style="background-color:#6d6d70; height:1px;"></div><br>
    <div class="container" style="max-width: 65%;">
    
            <div class="row mt-5">
              <div class="float-left mr-5 ml-5">
                <?php echo '<img src="data:image/png;base64,'.base64_encode($shopItem['image']).'" alt="'.$shopItem['name'].'" style="height: 25rem; width: 25rem; float:left;"/>'?>
              </div>
              <div class="mt-3" style="max-width: 30rem;">
                  <h1 id="detailName"><?php echo $shopItem['name'] ?></h1>
                  <h5 class="detail"><?php echo '$'.$shopItem['price'] ?></h5>
                  <p class="detail" style="display: inline-block;"><?php echo $shopItem['description'] ?></p>
                  <?php if($limit){?>
                    <p class="mt-auto btn cartBtn w-100">Add to Cart - <?php echo '$'.$shopItem['price'] ?></p>
                    <p style="color:red;">You already have our last item of that product in your cart</p>
                  <?php ?>
                  
                  <?php }elseif($shopItem['quantity_on_hand'] > 0){?>
                  <a href="detailedView.php?item=<?php echo $shopItem['id'] ?>&cart=yes" style="margin-top:150px;">
                    <button class="mt-auto btn btn-primary cartBtn w-100">Add to Cart - <?php echo '$'.$shopItem['price'] ?></button>
                  </a>
                  
                  <?php }else{?>
                    <p class="mt-auto btn cartBtn w-100">Add to Cart - <?php echo '$'.$shopItem['price'] ?></p>
                    <p style="color:red;">This item is currently out of stock sorry!</p>
                  <?php }?>
              </div>
            
            </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>