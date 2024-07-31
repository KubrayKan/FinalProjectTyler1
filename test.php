<?php
include 'accounts.php';
include 'CartItem.php';
include 'orders.php';

// $accounts = new Accounts();

// $users = $accounts->getUsername("admin1");

// echo $users['username'], $users['password'];

// $noUser = $accounts->getUsername("bruh");

// if($noUser == "Empty"){
//     echo "</br>bruh moment";
// }

// $correctLogIn = $accounts->getUsername("admin1");
// $pass = "admin123";
// if($correctLogIn['password'] == $pass){
//     echo"</br>nice";
// }

// $incorrectLogIn = $accounts->getUsername("admin1");
// $wrongPass = "admin";
// if($correctLogIn['password'] != $wrongPass){
//     echo"</br> not nice";
// }

// if(isset($_COOKIE["cart"])){
//     $data = json_decode($_COOKIE["cart"]);
//     echo $data[0];
//     echo $data[1];
// }
// else{
//     echo "Sorry, cookie not recognized!"."<br/>";
// }

// $item1 = new CartItem("nigga");
// $item1->display();
// $item1->increase_quantity();
// $item1->increase_quantity();
// echo "</br>";
// $item1->display();
// $item1->decrease_quantity();
// echo "</br>";
// $item1->display();
// $item1->decrease_quantity();
// echo "</br>";
// $item1->display();

// echo "</br>";
// $item2 = new CartItem("bruh");
// $item2->display();

// echo "</br>";
// $item3 = new CartItem("nigga");
// $item3->display();

// echo "</br>";
// $item4 = new CartItem("bruh");
// $item4->display();

// echo "</br>";
// $item5 = new CartItem("lmao");
// $item5->display();

// if($item1->equals($item2)){
//     echo "</br>";
//     echo "item 1 and 2 are equal";
// }


// if($item1->equals($item3)){
//     echo "</br>";
//     echo "item 1 and 3 are equal";
// }

// $data = array();
// $data[] = $item1;
// $data[] = $item2;
// echo "</br>";

// foreach($data as $value){
//     $value->display();
//     echo "</br>";
// }

// foreach($data as $value){
//     if($value->equals($item3)){
//         $value->increase_quantity();
//     }
// }

// foreach($data as $value){
//     $value->display();
//     echo "</br>";
// }

// foreach($data as $value){
//     if($value->equals($item3)){
//         $value->increase_quantity();
//     }
// }

// foreach($data as $value){
//     $value->display();
//     echo "</br>";
// }

// foreach($data as $value){
//     if($value->equals($item4)){
//         $value->increase_quantity();
//     }
// }

// foreach($data as $value){
//     $value->display();
//     echo "</br>";
// }

// $isIn = false;
// foreach($data as $value){
//     if($value->equals($item5)){
//         $value->increase_quantity();
//         $isIn = true;
//     }
// }

// if(!$isIn){
//     $data[] = $item5;
// }

// foreach($data as $value){
//     $value->display();
//     echo "</br>";
// }

// setcookie("cart", "", time()-60, "/", "", 0);
// echo "</br></br> COOKIES </br>";
// if(isset($_COOKIE["cart"])){
//     $data = json_decode($_COOKIE["cart"]);
//     $x = array();
//     foreach($data as $value){
//         $x[] = new CartItem($value->id, $value->quantity);
//     }
// }
// else{
//     echo "Sorry, cookie not recognized!"."<br/>";
// }

// foreach($x as $value){
//     echo "</br>";
//     $value->display();
// }
// echo "</br>";

// $toBeFound = new CartItem("1", 2);
// // array_splice($x, array_search($toBeFound, $x), 1);
// $x[array_search($toBeFound, $x)]->decrease_quantity();

// foreach($x as $value){
//     echo "</br>";
//     $value->display();
//}

$orderObject = new Orders();
$orders = $orderObject->search("guillermo");
foreach($orders as $order){
    echo "</br>".$order['username'];
    echo "</br>".$order['items'];
    echo "</br>".$order['orderTotal'];
    echo "</br>".$order['purchaseDate'];
    echo "</br>".$order['nameHolder'];
    echo "</br>".$order['cardNumber'];
    echo "</br>".$order['expirationDate'];
    echo "</br>".$order['securityNumber'];
}

$username = "guillermo";
$items = "Nibba, Lebron";
$orderTotal = 12.50;
$purchaseDate = date("Y/m/d");
$nameHolder = "guillermo";
$cardNumber = "123456";
$expirationDate = "05/20";
$securityNumber = "456";

//$orderObject->placeOrder($username, $items, $orderTotal, $purchaseDate, $nameHolder, $cardNumber, $expirationDate, $securityNumber) 

?>