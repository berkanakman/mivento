<?php

    include_once "connection.php";

    function get_all_records(){
        $Sql = "SELECT * FROM employeeinfo";
        $result = mysqli_query($conn, $Sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
                 <thead><tr><th>EMP ID</th>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Email</th>
                              <th>Registration Date</th>
                            </tr></thead><tbody>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row['emp_id']."</td>
                       <td>" . $row['firstname']."</td>
                       <td>" . $row['lastname']."</td>
                       <td>" . $row['email']."</td>
                       <td>" . $row['reg_date']."</td></tr>";
            }

            echo "</tbody></table></div>";

        } else {
            echo "you have no records";
        }
    }

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
