<?php
include_once("../accounts.php");
$accounts = new Accounts();
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black;">
  <?php if(isset($_COOKIE['username'])){?>
  <a class="navbar-brand" href="home.php"><?php echo $_COOKIE['username']?></a>
  <?php }else{ ?>
  <a class="navbar-brand" href="home.php">Loltyler1.com</a>
  <?php } ?>
  <button class="navbar-toggler collapsed ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
        <li id="homeNav" class="nav-item active">
            <a class="nav-link" href="../home.php">Home</a>
        </li>
        <li id="shopNav"class="nav-item">
            <a class="nav-link" href="../shop.php">Shop</a>
        </li>
        <li id="calendarNav"class="nav-item">
            <a class="nav-link" href="../calendar.php">Calendar</a>
        </li>
        <li id="orderNav"class="nav-item">
            <a class="nav-link" href="../orderHistory.php">Order History</a>
        </li>
        <li id="customerContactNav"class="nav-item">
            <a class="nav-link" href="../customerContact.php">Customer Contact</a>
        </li>
        <li id="ticketNav"class="nav-item">
            <a class="nav-link" href="../ticketHistory.php">Ticket History</a>
        </li>
        <?php
         if(isset($_COOKIE["username"])) {
   
             $adminList = $accounts -> getUserRole($_COOKIE["username"]);
             foreach($adminList as $user) {
               if($user["username"] == $_COOKIE["username"]) {
        ?>
        <li id="adminShop"class="nav-item">
            <a class="nav-link" href="adminShop.php">Admin</a>
        </li>
        <?php
              }
            }
          }
            ?>
    </ul>
    <div class="navbar-nav">

    <li id="cartNav"class="nav-item">
      <a class="nav-link" href="../cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
    </li>

    <?php
      if(isset($_COOKIE["username"]))
      {?>
        
          <a class="nav-item nav-link" href="../logOut.php?previous=<?php echo $_SERVER['REQUEST_URI'];?>">Log Out</a>
          <a class="nav-item nav-link" href="../changePassword.php?previous=<?php echo $_SERVER['REQUEST_URI'];?>">Change Password</a>
          <a class="nav-item nav-link" href="../deleteAccount.php?previous=<?php echo $_SERVER['REQUEST_URI'];?>">Delete Account</a>
        
        <?php
      }
      else
      {?>
          <a class="nav-item nav-link" href="../loginAccount.php?previous=<?php echo $_SERVER['REQUEST_URI'];?>">Log In</a>
          <a class="nav-item nav-link" href="../createAccount.php?previous=<?php echo $_SERVER['REQUEST_URI'];?>">Create Account</a>
    <?php
      }
    ?>
    </div>
  </div>
  <div>
  </div>
</nav>