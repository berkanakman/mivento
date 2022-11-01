<?php
        function getdb(){
        $servername = "localhost";
        $username = "";
        $password = "";
        $db = "mivento";
        try {
            $conn = new mysqli($servername, $username, $password, $db);
            //echo "Connected successfully";
        } catch(exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
?>
