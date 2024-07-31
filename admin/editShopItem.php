<?php
  
  // Include database file
  include 'adminShopController.php';

  $shopController = new AdminShopController();

  // Edit shopItem record
  if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $shopItem = $shopController->displayRecordById($editId);
  }

  // Update Record in shopItem table
  if(isset($_POST['update'])) {
      echo "<h2>".$shopController->updateShopItem($_POST);"</h2>";
  }  
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Edit Shop Item | Loltyler1.com</title>
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
?>

<div class="text-center" style="padding:15px;">
  <h2><?php echo $shopItem['name']; ?></h4>
</div><br> 

<div class="container">
  <form action="editShopItem.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="uName">Name:</label>
      <input type="text" class="form-control" name="uName" value="<?php echo $shopItem['name']; ?>" required="">
    </div>
    <div class="form-group">
      <label for="uDescription">Description:</label>
      <input type="text" class="form-control" name="uDescription" value="<?php echo $shopItem['description']; ?>" required="">
    </div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="text" class="form-control" name="uPrice" value="<?php echo $shopItem['price']; ?>" required="">
    </div>
    <div class="form-group">
      <label for="uImage">Image: </label>
      <input type="file" class="form-control-file text-white" name="uImage" accept="image/png, image/jpeg">
    </div>
    <div class="form-group">
      <label for="uQuantityOnHand">Quantity on hand:</label>
      <input type="text" class="form-control" name="uQuantityOnHand" value="<?php echo $shopItem['quantity_on_hand']; ?>" required="">
    </div>
    <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $shopItem['id']; ?>">
      <input type="submit" name="update" class="btn btn-primary submitButton" style="float:right;" value="Update">
      <a class="btn btn-primary submitButton" href="adminShop.php">Cancel</a>
    </div>
  </form>
</div>
</body>
</html>