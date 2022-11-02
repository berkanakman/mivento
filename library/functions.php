<?php
    include_once "connection.php";

    function phoneFormater($phone) {
        $phone  = preg_replace("/[^0-9]/", "", $phone);
        $first = substr("$phone",0,1);
        if($first == "0") { $phone = substr($phone,1); }

        $doksan = substr("$phone",0,2);

        if($doksan == "90") {
            $number = substr($phone, 2);
        } else {
            $number = substr($phone, 0);
        }
        if(substr("$number",0,1) == "0") {
            $number = substr($number,1); }

        return $number;
    }

    function campaignControl($campaignName, $campaignDate) {
        $conn = getdb();
        $controlResult = $conn->prepare("SELECT * FROM campaign WHERE name = ? and date = ?");
        $controlResult->bind_param('ss', $campaignName, $campaignDate);

        if(!$controlResult->execute()){
            logger('Control Result Error (campaignControl) : ', $controlResult->error);
        }

        $controlResult = $controlResult->get_result();
        $controlResult = $controlResult->fetch_array(MYSQLI_ASSOC);

        return $controlResult;
    }

    function employeeControl($campaignID, $email, $employeeID, $phone) {
        $conn = getdb();
        $controlResult = $conn->prepare("SELECT * FROM employee WHERE campaign_id = ? AND (email = ? OR employee_id = ? OR phone = ?)");
        $controlResult->bind_param('isis', $campaignID, $email, $employeeID, $phone);

        if(!$controlResult->execute()){
            logger('Control Result Error (employeeControl) : ', $controlResult->error);
        }

        $controlResult = $controlResult->get_result();
        $controlResult = $controlResult->fetch_array(MYSQLI_ASSOC);

        return $controlResult;
    }

    function logger($logMsg="Error", $logData="", $filename="errors_")
    {
        $log  = date("d.m.Y H:i:s")." || $logMsg : ".print_r($logData,1).PHP_EOL .
            "-------------------------".PHP_EOL;
        file_put_contents('../logs/'.$filename.date("d_m_Y").'.log', $log, FILE_APPEND);
    }


?>
