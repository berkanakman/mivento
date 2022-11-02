<?php
        function getdb(){
        $servername = "94.73.146.71";
        $username = "u0921624_user74D";
        $password = "sIR-53o8B6cd=.-D";
        $db = "u0921624_db74D";
        try {
            $conn = new mysqli($servername, $username, $password, $db);
            //echo "Connected successfully";
        } catch(exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
?>
