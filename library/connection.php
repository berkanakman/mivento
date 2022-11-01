<?php
        function getdb(){
        $servername = "localhost";
        $username = "berkan";
        $password = "123456";
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
