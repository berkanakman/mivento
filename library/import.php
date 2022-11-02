<?php
    require_once "functions.php";

    if(isset($_POST["Import"])){
        try {
            $error = ['Error' => [
                'status' => 0,
                'errorMessage' => 'Kayıtlar içeriye aktarılamadı.'
            ]];
            $conn = getdb();
            $filename = $_FILES["campaignFile"]["tmp_name"];
            if ($_FILES["campaignFile"]["size"] > 0) {
                $file = fopen($filename, "r");
                $row = 1;
                $duplicate = [];

                $campaignControl = campaignControl($_POST["campaignName"], $_POST["campaignDate"]);

                if(!is_null($campaignControl)) {
                    $campaignID = $campaignControl['id'];
                } else {
                    $controlResult = $conn->prepare("INSERT INTO campaign (name, date) VALUES (?,?)");
                    $controlResult->bind_param('ss', $_POST["campaignName"], $_POST["campaignDate"]);

                    if(!$controlResult->execute()){
                        logger('Control Result Error : ', $controlResult->error);
                    }

                    $campaignID = $controlResult->insert_id;
                }

                while (($getData = fgetcsv($file, 10000, ";")) !== FALSE) {
                    if ($row == 1) {
                        $row++;
                        continue;
                    }
                    $phone = phoneFormater($getData[4]);

                    $employeeControl = employeeControl($campaignID, $getData[2], $getData[3], $phone);

                    if(!is_null($employeeControl)) {
                        $duplicate['duplicate'][] = [
                            "csvData" => $getData,
                            "databaseData" => $employeeControl
                        ];
                    } else {
                        $result = $conn->prepare("INSERT INTO
                                  employee (
                                    campaign_id,
                                    name,
                                    surname,
                                    email,
                                    employee_id,
                                    phone,
                                    point
                                  )
                                VALUES (?,?,?,?,?,?,?)");

                        $result->bind_param('isssisi', $campaignID, $getData[0], $getData[1], $getData[2], $getData[3], $phone, $getData[5]);

                        if(!$result->execute()){
                            $error = ['Error' => [
                                'status' => 0,
                                'errorMessage' => 'Kayıtlar içeriye aktarılamadı.'
                            ]];

                            logger('Employe Input Error : ', $result->error);
                            break;
                        }

                        $error = ['Error' => [
                            'status' => 1,
                            'errorMessage' => 'Kayıtlar içeriye aktarıldı.'
                        ]];
                    }
                }

                $return = array_merge($error, $duplicate);

                echo json_encode($return);

                $conn->close();
                fclose($file);
            }
        } catch(exception $e) {
            logger('Input Error : ', $e->getMessage());
        }
    }
