<?php
// Create the class Customers
class ShopItems{
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
    public function displayData($sortBy)
    {
        $results_per_page = 6;

        //find the total number of results stored in the database
        $query = "SELECT * FROM shopItems";
        $result = $this->con->query($query);
        $number_of_result = $result->num_rows;
  
        //determine the total number of pages available
        $number_of_page = ceil ($number_of_result / $results_per_page);

        $_SESSION["numPagesTotal"] = $number_of_page;

        //determine which page number visitor is currently on
        if (!isset ($_GET['page']) )
        {
            $page = 1;
        } 
        
        else
        {
            $page = $_GET['page'];
        }
    
        //determine the sql LIMIT starting number for the results on the displaying page
        $page_first_result = ($page-1) * $results_per_page;

        switch($sortBy) 
        { 
            case "ascName": 
                $query = "SELECT * FROM shopItems ORDER BY name ASC LIMIT " . $page_first_result . ',' . $results_per_page;
            break;
            case "descName":
                $query = "SELECT * FROM shopItems ORDER BY name DESC LIMIT " . $page_first_result . ',' . $results_per_page;
            break;
            case "ascPrice":
                $query = "SELECT * FROM shopItems ORDER BY price ASC LIMIT " . $page_first_result . ',' . $results_per_page;
            break;
            case "descPrice":
                $query = "SELECT * FROM shopItems ORDER BY price DESC LIMIT " . $page_first_result . ',' . $results_per_page;
            break;
            default:
            $query = "SELECT * FROM shopItems LIMIT " . $page_first_result . ',' . $results_per_page;
        }

        $result = $this->con->query($query);
        
        if($result->num_rows > 0){
            $data = array();
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        else{
            echo "No records found";
        }
        
    }


    //Search all products by using a keyword
    public function search($searchWord)
    {
        $searchWord = $this->con->real_escape_string($searchWord);

        $query = "SELECT * FROM shopItems WHERE name LIKE '%$searchWord%' OR description LIKE '%$searchWord%'";
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            $data = array();
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        else{
            $_SESSION["errorMessage"] = "No data found.";
        }
    }

    //Search all products by using a keyword
    public function displayShopItemById($id)
    {
        $searchId = $this->con->real_escape_string($id);
        $query = "SELECT * FROM shopItems WHERE id = '$searchId'";
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            $data = $result->fetch_assoc();           
            return $data;
        }
        else{
            echo "Record not found";
        }
    }
    
    public function changeQuantity($id, $quantity)
    {
        $searchId = $this->con->real_escape_string($id);
        $newQuantity = $this->con->real_escape_string($quantity);
        $query = "UPDATE shopitems SET quantity_on_hand='$newQuantity' WHERE id = '$searchId'";
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