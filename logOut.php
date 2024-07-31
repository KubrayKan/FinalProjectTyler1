<?php
    setcookie("username", "", time()-60, "/", "", 0);
    setcookie("cart", "", time()-60, "/", "", 0);
    $previous = $_GET['previous'];
    header("Location: ".$previous);
    exit();
?>