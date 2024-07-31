<?php
  
  // Include database file
  include 'shopItems.php';

  $shopItems = new ShopItems();
  $item1 = $shopItems->displayShopItemById(1);
  $item2 = $shopItems->displayShopItemById(2);
  $item3 = $shopItems->displayShopItemById(3);
  $item4 = $shopItems->displayShopItemById(5);
    
  
    if(isset($_GET['search']) && !empty($_GET['search']))
    {
        $searchWord = $_GET['search'];
        $items = $shopItems->search($searchWord);
    }

    else if (isset($_GET['search']) && $_GET['search'] == '') {
      echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL=shop.php">';
      exit;
    }

    else {
      $items = $shopItems->displayData("");
    }

    if(isset($_GET['sortBy']) && !empty($_GET['sortBy']))
    {
        $sortBy = $_GET['sortBy'];
        $items = $shopItems->displayData($sortBy);
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/gif" href="https://preview.ibb.co/j2A5Yo/fav.gif">
  <title>Shop | Loltyler1.com</title>
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
  document.getElementById("shopNav").classList.add('active');
  document.getElementById("homeNav").classList.remove('active');
  </script>

<div class="jumbotron text-center" id="topCard">
    <img src="https://assets.bigcartel.com/theme_images/51543572/t3.png?auto=format&amp;fit=max&amp;h=250&amp;w=1300" alt="Loltyler1.com Home" style="margin-top:100px;"> 
</div>

<div style="background-color:#6d6d70; height:1px;"></div><br>


<h2 class="text-center" style="margin-bottom:20px;">These are our featured products of the shop today</h2>
<div id="demo" class="carousel slide" data-ride="carousel" style="width:25%; margin: auto;">

  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <div class="carousel-inner">
    <div class="carousel-item active">
      <?php echo '<img src="data:image/png;base64,'.base64_encode($item1['image']).'" alt="'.$item1['name'].'" style="width:100%"/>'?>
    </div>
    <div class="carousel-item">
      <?php echo '<img src="data:image/png;base64,'.base64_encode($item2['image']).'" alt="'.$item2['name'].'" style="width:100%"/>'?>
    </div>
    <div class="carousel-item">
      <?php echo '<img src="data:image/png;base64,'.base64_encode($item3['image']).'" alt="'.$item3['name'].'" style="width:100%"/>'?>
    </div>
  </div>
  
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

<div class="container">
  <h2>Shop</h2>

  <div class="row">
    <form class="mb-5" id="searchSubmit" method="GET">
    <div class="input-group mb-2">
      <input class="form-control-sm" type="text" placeholder="Search.." name="search">
      <input type="hidden" name="page" value="1">
      <div class="input-group-btn">
          <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-search"></i></button>
      </div>
      </div>
    </form>

    <div class="ml-auto">
        <div class="btn-group" role="group">
          <button id="sortBy" type="button" class="btn btn-primary submitButton dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort By</button>
          <div class="dropdown-menu" aria-labelledby="sortBy">
            <a class="dropdown-item" href="shop.php?sortBy=ascName&page=1">Name Ascending</a>
            <a class="dropdown-item" href="shop.php?sortBy=descName&page=1">Name Descending</a>
            <a class="dropdown-item" href="shop.php?sortBy=ascPrice&page=1">Price Ascending</a>
            <a class="dropdown-item" href="shop.php?sortBy=descPrice&page=1">Price Descending</a>
          </div>
        </div>

    </div>
  </div>
    <?php
    if(isset($_SESSION["errorMessage"])) {
        echo '<h3 class="text-white">'.$_SESSION["errorMessage"].'</h3>';
      }
      else {

    ?>
  <div class="row">

        <?php 

          if(!isset($items)) {
            $items = $shopItems->displayData("");
          }

          foreach ($items as $shopItem) 
          {
        ?>

        <div class="col-sm-5 col-lg-4">
          <a class="card-link mb-4" href="detailedView.php?item=<?php echo $shopItem['id'] ?>">
            
            <?php echo '<img class="card-img-top" src="data:image/png;base64,'.base64_encode($shopItem['image']).'" alt="'.$shopItem['name'].'" style="max-height:22rem;"/>'?>
            
              <div class="card-body d-flex flex-column">
                  <h4 class="text-center"><?php echo $shopItem['name'] ?></h4>
                  <p class="price text-center purple" style="font-weight: bold;"><?php echo '$'.$shopItem['price'] ?></p>
                  <button class="mt-auto btn btn-primary cartBtn">View</button>
              </div>
          </a>
        </div>
      
      <?php 
          } 
      }?>

  </div>
</div>
  <nav class="mt-5" aria-label="Pagination navigation">
    <ul class="pagination justify-content-center">
      <?php
      if(isset($_SESSION["numPagesTotal"])) {
        
        //display the link of the pages in URL
        for($page = 1; $page<= $_SESSION["numPagesTotal"]; $page++) {
          if(isset($_GET['page']) && $page == $_GET['page']) {
            
            echo '<li class="page-item active" aria-current="page"><a class="page-link" href="shop.php?page=' . $page . '">' . $page . ' </a></li>';
          }

          else if (isset($_GET['page']) && $page != $_GET['page']) {
            $url=http_build_query(array_merge($_GET, array("page"=>$page)));
            echo '<li class="page-item"><a class="page-link" href="shop.php?' . $url . '">' . $page . ' </a></li>';
          }

          else if (!isset($_GET['page']) && $page == 1) {
            $url=http_build_query(array_merge($_GET, array("page"=>1)));
            echo '<li class="page-item active" aria-current="page"><a class="page-link" href="shop.php?' . $url . '">' . $page . ' </a></li>';
          }
          else {
            $url=http_build_query(array_merge($_GET, array("page"=>$page)));
            echo '<li class="page-item"><a class="page-link" href="shop.php?' . $url . '">' . $page . ' </a></li>';
        
          }
        }
      } 
      ?>
    </ul>
  </nav>
</body>
</html>