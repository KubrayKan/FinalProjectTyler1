<?php
class Accounts{
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

    public function displayData()
    {
        $query = "SELECT * FROM useraccounts";
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            $data = array();
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        else{
            echo "No found records";
        }
    }


    public function getUsername($username)
    {
        $searchUsername = $this->con->real_escape_string($username);
        $query = "SELECT * FROM useraccounts WHERE username = '$searchUsername'";
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            $data = $result->fetch_assoc();           
            return $data;
        }
        else{
            $data = "Empty";
            return $data;
        }
    }

    public function getUserRole($username)
    {
        $query = 'SELECT username FROM useraccounts WHERE role="admin"';
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            $data = array();
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        else{
            echo "No found records";
        }
    }

    public function changePassword($username, $password)
    {
        $searchUsername = $this->con->real_escape_string($username);
        $newPassword = $this->con->real_escape_string($password);
        $query = "UPDATE useraccounts SET password='$newPassword' WHERE username = '$searchUsername'";
        $resultQuery = $this->con->query($query);
        if(!$resultQuery){
            $result = "bad";
        }
        else{
            $result = "good";
        }
        return $result;
    }

    public function deleteAccount($username)
    {
        $searchUsername = $this->con->real_escape_string($username);
        $query = "DELETE FROM useraccounts WHERE username = '$searchUsername'";
        $resultQuery = $this->con->query($query);
        if(!$resultQuery){
            $result = "bad";
        }
        else{
            $result = "good";
        }
        return $result;
    }

    public function createAccount($post)
    {
        $username = $email = $password = $city = $province = $country = '';
        if($post['username'] || $post['email'] || $post['city'] || $post['password'] || $post['province'] || $post['country']){
            $username = $post['username'];
            $email = $post['email'];
            $password =  $post['password'];
            $city = $post['city'];
            $province = $post['province'];
            $country = $post['country'];
        }
        $query = "INSERT INTO useraccounts VALUES(NULL,'$username','$email','$password',NULL,'$city','$province','$country')";
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