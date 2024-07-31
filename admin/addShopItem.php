<?php

include 'adminShopController.php';

$shopController = new AdminShopController();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Add Shop IteM | Loltyler1.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
  <link rel="stylesheet" href="../loltyler1.css"/>
</head>
<body>

<?php
  include_once('adminNavBar.php');

  if(isset($_POST['submit']))
{
    echo "<br><br><h2>".$shopController->addShopItem($_POST)."</h2>";
}
?>

<script>
  document.getElementById("adminShop").classList.add('active');
  document.getElementById("homeNav").classList.remove('active');
</script>

<div class="text-center" style="padding:15px;">
  <h4>Add New Item</h4>
  <?php

  if(isset($_POST['submit']))
  {
    echo "<h2>".$shopController->addShopItem($_POST)."</h2>";
  }

  ?>

<div class="container">
  <form action="addShopItem.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name" placeholder="Enter name" required="">
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <input type="text" class="form-control" name="description" placeholder="Enter description" required="">
    </div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="text" class="form-control" name="price" placeholder="Enter price" required="">
    </div>
    <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" class="form-control-file text-white" name="image" required="" accept="image/png, image/jpeg">
    </div>
    <div class="form-group">
      <label for="quantity">Quantity On Hand:</label>
      <input type="text" class="form-control" name="quantity" placeholder="Enter the quantity on hand" required="">
    </div>
    <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
      <input type="submit" name="submit" class="mt-3 btn btn-primary submitButton" style="float:right;" value="Add Item">
    </div>
  </form>
  <a class="btn btn-primary submitButton mt-3" href="adminShop.php">Cancel</a>
</div>
</body>
</html>