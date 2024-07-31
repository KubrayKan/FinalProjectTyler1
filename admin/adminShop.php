<?php
  
  // Include database file
  include '../shopItems.php';
  include 'adminShopController.php';

  $shopItems = new ShopItems();
  $shopController = new AdminShopController();
    
    if(isset($_GET['search']) && !empty($_GET['search']))
    {
        $searchWord = $_GET['search'];
        $items = $shopItems->search($searchWord);
    }

    if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
      $deleteId = $_GET['deleteId'];
      $shopController->removeShopItem($deleteId);
      header("Location: adminShop.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Admin Shop | Loltyler1.com</title>
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
<div style="margin-bottom:70px;"></div>

<script>
  document.getElementById("adminShop").classList.add('active');
  document.getElementById("shopNav").classList.remove('active');
  document.getElementById("homeNav").classList.remove('active');
  document.getElementById("calendarNav").classList.remove('active');
  document.getElementById("cartNav").classList.remove('active');
  document.getElementById("orderNav").classList.remove('active');
  </script>


<div style="background-color:#6d6d70; height:1px;"></div><br>

<div class="container">

  <h2>Shop</h2>

  <div class="row mb-5">
    <form id="searchSubmit" action="" method="GET">
    <div class="input-group mb-2">
      <input class="form-control-sm" type="text" placeholder="Search.." name="search">
      <div class="input-group-btn">
          <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-search"></i></button>
      </div>
      </div>
    </form>

      <a href="addShopItem.php" class="btn btn-primary submitButton float-right mb-auto ml-auto">Add New Record</a>

  </div>
  
  <div class="row">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Image</th>
            <th style="min-width: 15rem;">Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Edit/Remove Item</th>
          </tr>
        </thead>
        <tbody>
        <?php 

            if(!isset($items)) {
                $items = $shopItems->displayData("");
            }

            foreach ($items as $shopItem) {
        ?>
            <tr>
                <td class="text-white"><?php echo '<img class="card-img-top" src="data:image/png;base64,'.base64_encode($shopItem['image']).'" alt="'.$shopItem['name'].'" style="max-height:22rem; max-width:22rem;"/>'?></td>
                <td class="text-white"><?php echo $shopItem['name'] ?></td>
                <td class="text-white"><?php echo $shopItem['description'] ?></td>
                <td class="text-white"><?php echo '$'.$shopItem['price'] ?></td>
                <td>
                <a class="ml-4 mr-4" href="editShopItem.php?editId=<?php echo $shopItem['id'] ?>" style="color:green">
                  <i class="fa fa-pencil" aria-hidden="true"></i></a>
                <a href="adminShop.php?deleteId=<?php echo $shopItem['id'] ?>" style="color:red" onclick="confirm('Are you sure want to delete this record')">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
  </div>
  <nav class="mt-5" aria-label="Pagination navigation">
    <ul class="pagination justify-content-center">
      <?php
      if(isset($_SESSION["numPagesTotal"])) {
        
        //display the link of the pages in URL
        for($page = 1; $page<= $_SESSION["numPagesTotal"]; $page++) {
          if(isset($_GET['page']) && $page == $_GET['page']) {
            
            echo '<li class="page-item active" aria-current="page"><a class="page-link" href="adminShop.php?page=' . $page . '">' . $page . ' </a></li>';
          }

          else if (isset($_GET['page']) && $page != $_GET['page']) {
            $url=http_build_query(array_merge($_GET, array("page"=>$page)));
            echo '<li class="page-item"><a class="page-link" href="adminShop.php?' . $url . '">' . $page . ' </a></li>';
          }

          else if (!isset($_GET['page']) && $page == 1) {
            $url=http_build_query(array_merge($_GET, array("page"=>1)));
            echo '<li class="page-item active" aria-current="page"><a class="page-link" href="adminShop.php?' . $url . '">' . $page . ' </a></li>';
          }
          else {
            $url=http_build_query(array_merge($_GET, array("page"=>$page)));
            echo '<li class="page-item"><a class="page-link" href="adminShop.php?' . $url . '">' . $page . ' </a></li>';
        
          }
        }
      } 
      ?>
    </ul>
  </nav>
</div>
</body>
</html>