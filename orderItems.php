<?php 

    class OrderItems{
        private $servername = "localhost";
        private $username = "root";
        private $password ="";
        private $database ="loltyler1merch";
        public $con;

        function __construct() {
            $this->con = $this->connectDB();
        }

        function connectDB() {
            $con = mysqli_connect($this->servername,$this->username,$this->password,$this->database);
            return $con;
        }

        function runQuery($query) {
            $result = mysqli_query($this->con,$query);
            while($row=mysqli_fetch_assoc($result)) {
                $resultset[] = $row;
            }		
            if(!empty($resultset))
                return $resultset;
        }

        function numRows($query) {
            $result  = mysqli_query($this->con,$query);
            $rowcount = mysqli_num_rows($result);
            return $rowcount;	
        }
	}
  ?>