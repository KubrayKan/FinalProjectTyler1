<?php
// Create the class AdminShopController
class AdminShopController{
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
        $query = "SELECT * FROM shopItems";
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

    // Insert new shop item
    public function addShopItem($post)
    {
        // If file upload form is submitted 
            if(!empty($_FILES["image"]["name"])) {
                // Get file info 
                $fileName = basename($_FILES["image"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                
                // Allow certain file formats 
                $allowTypes = array('jpg','png','jpeg','gif'); 
                if(in_array($fileType, $allowTypes)){ 
                    $image = $_FILES['image']['tmp_name']; 
                    $imgContent = addslashes(file_get_contents($image)); 
                    $name = $this->con->real_escape_string($_POST['name']);
                    $description = $this->con->real_escape_string($_POST['description']);
                    $price = $this->con->real_escape_string($_POST['price']);
                    $quantityOnHand = $this->con->real_escape_string($_POST['quantity']);

                    // Insert data content into database 
                    $insert = $this->con->query("INSERT INTO shopItems(name, description, price, image, quantity_on_hand) VALUES ('$name', '$description', '$price', '$imgContent', '$quantityOnHand')");
                    
                    if($insert){ 
                        $statusMsg = "File uploaded successfully."; 
                    }else{ 
                        $statusMsg = "File upload failed, please try again."; 
                    }  
                }else{ 
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
                } 
            }else{ 
                $statusMsg = 'Please select an image file to upload.'; 
            }
            return $statusMsg;
        
    }

    //Get shop item by id
    public function displayRecordById($id)
    {
        $query = "SELECT * FROM shopItems WHERE id = '$id'";
        $result = $this->con->query($query);
        if($result->num_rows > 0){
            $data = $result->fetch_assoc();           
            return $data;
        }
        else{
            echo '<script>alert("Record not found")</script>'; 
        }
    }

    //Update shop item
    public function updateShopItem($postData)
    {
        if(empty($_FILES["uImage"]["name"])) {

            $name = $this->con->real_escape_string($_POST['uName']);
            $description = $this->con->real_escape_string($_POST['uDescription']);
            $price = $this->con->real_escape_string($_POST['uPrice']);
            $quantityOnHand = $this->con->real_escape_string($_POST['uQuantityOnHand']);
            $id = $this->con->real_escape_string($_POST['id']);
            if(!empty($id) && !empty($postData)){
                $query = "UPDATE shopItems SET name = '$name', description = '$description', price= '$price', quantity_on_hand='$quantityOnHand' WHERE id = '$id'";
                $sql = $this->con->query($query);
                if($sql){
                    header("Location: adminShop.php");
                }
                else{
                    $statusMsg = "File upload failed, please try again."; 
                }
                return $statusMsg;
            }
        }
        else 
        {
                $fileName = basename($_FILES["uImage"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                
                // Allow certain file formats 
                $allowTypes = array('jpg','png','jpeg','gif'); 
                if(in_array($fileType, $allowTypes))
                {
                    $image = $_FILES['uImage']['tmp_name']; 
                    $imgContent = addslashes(file_get_contents($image)); 
                    $name = $this->con->real_escape_string($_POST['uName']);
                    $description = $this->con->real_escape_string($_POST['uDescription']);
                    $price = $this->con->real_escape_string($_POST['uPrice']);
                    $quantityOnHand = $this->con->real_escape_string($_POST['uQuantityOnHand']);
                    $id = $this->con->real_escape_string($_POST['id']);
                    if(!empty($id) && !empty($postData)){
                        $query = "UPDATE shopItems SET name = '$name', description = '$description', price= '$price', image='$imgContent', quantity_on_hand='$quantityOnHand' WHERE id = '$id'";
                        $sql = $this->con->query($query);
                        if($sql){
                            header("Location: adminShop.php");
                        }
                        else{
                            $statusMsg = "File upload failed, please try again."; 
                        }
                        return $statusMsg;
                    }
                }
                else
                {
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
                }
            
                return $statusMsg;
        }
    }
    

    //Removes shop item from database
    public function removeShopItem($id)
    {
        $query = "DELETE FROM shopItems WHERE id = '$id'";
        $sql = $this->con->query($query);
        if($sql==true){
            echo "Record deleted sucessfully";
        }
        else{
            echo "Not possible to delete, please try again!";
        }
    }

}





?>