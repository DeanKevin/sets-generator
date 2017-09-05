<?php
/*
 * Database class
 *
 */
 class DB {
    // properities
    var $servername = "localhost";
    var $username = "sets";
    var $password = "secret";
    
    // Methods
    // ToDo: Make this function a constructor method.
    function connect() {
        try
        {
            $conn = new PDO("mysql:host=$this->servername;dbname=sets", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return array('conn' => $conn, 'status' => true, 'message' => 'success'); 
        }
        catch(PDOException $e)
        {
            return array('conn' => '', 'status' => false, 'message' => $e->getMessage());
        }
    }
}
?>