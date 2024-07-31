<?php
// Create the class Orders
class Orders{
    private $servername = "localhost";
    private $username = "root";
    private $password ="";
    private $database ="loltyler1merch";
    public $con;

    // Create connection string (Database connection)
    public function __construct()
    {
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if(mysqli_connect_error())
        {
            trigger_error("Not possible to connect to MySQL: ".mysqli_connect_error());
        }
        else
        {
            return $this->con;
        }
    }

    // Fetching shop items
    public function displayData()
    {
        $query = "SELECT * FROM orderhistory";
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            $data = array();
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        else{
            $data = array();
            $data[] = "None";
        }
    }

    //Search all products by using a keyword
    public function search($username)
    {
        $searchUsername = $this->con->real_escape_string($username);
        $query = "SELECT * FROM orderhistory WHERE username = '$searchUsername'";
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            $data = array();
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        else{
            return null;
        }
    }

    public function placeOrder($username, $items, $orderTotal, $purchaseDate, $nameHolder, $cardNumber, $expirationDate, $securityNumber, $address)
    {
        $query = "INSERT INTO orderhistory VALUES(NULL,'$username','$items','$orderTotal','$purchaseDate','$nameHolder','$cardNumber','$expirationDate','$securityNumber','$address')";
        $resultQuery = $this->con->query($query);
        if(!$resultQuery){
            $result = "bad";
        }
        else{
            $result = "good";
        }
        return $result;
    }

}

?>