<?php
$apikey   = "177b4be3a4df720a5498b5a52d0e9107c5e57eada101482b1f181f5207ba9f83";
$base_url = "http://34.241.71.67:3333";
$ip       = get_client_ip();
header('Content-type: application/json');
if (isset($_POST)) {
    $content = file_get_contents("php://input");
    $decoded = json_decode($content, true);
    $service = $decoded['service'];
    
    //Creating an Email
    if ($service == "emailCreate") {
        $url     = '' . $base_url . '/api/templates/?api_key=' . $apikey;
        $name    = $decoded['name'];
        $subject = $decoded['subject'];
        $text    = $decoded['text'];
        $html    = $decoded['html'];
        $arr     = array(
            "name" => $name,
            "subject" => $subject,
            "text" => $text,
            "html" => $html
        );
        $ch      = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($arr)
        ));
        
        $response = curl_exec($ch);
        if ($response === FALSE) {
            die(curl_error($ch));
        }
        $responseData = json_decode($response, TRUE);
        //Receive message back from Server if error occured
        if (array_key_exists('message', $responseData)) {
            $json = '{"response":"' . $responseData['message'] . '", "alert_code":"danger"}';
            echo $json;
            return;
        } else {
            $result_name = $responseData['name'];
            $first_date  = $responseData['modified_date'];
            $result_date = explode("T", $first_date);
            $json        = '{"response":"Success! ' . $result_name . ' has been added! Last Modified: ' . $result_date[0] . '", "alert_code":"success"}';
            echo $json;
        }
    }
    //Creating a Landing Page Template
    else if ($service == "landingCreate") {
        $url      = '' . $base_url . '/api/pages/?api_key=' . $apikey;
        $name     = $decoded['name'];
        $capture  = $decoded['capture'];
        $redirect = $decoded['redirect'];
        $html     = $decoded['html'];
        $bool     = filter_var($capture, FILTER_VALIDATE_BOOLEAN);
        $arr      = array(
            "name" => $name,
            "html" => $html,
            "capture_credentials" => $bool,
            "capture_passwords" => $bool,
            "redirect_url" => $redirect
        );
        $ch       = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($arr)
        ));
        
        $response = curl_exec($ch);
        if ($response === FALSE) {
            die(curl_error($ch));
        }
        $responseData = json_decode($response, TRUE);
        //Receive message back from Server if error occured
        if (array_key_exists('message', $responseData)) {
            $json = '{"response":"' . $responseData['message'] . '", "alert_code":"danger"}';
            echo $json;
            return;
        } else {
            $result_name = $responseData['name'];
            $first_date  = $responseData['modified_date'];
            $result_date = explode("T", $first_date);
            $json        = '{"response":"Success! ' . $result_name . ' has been added! Last Modified: ' . $result_date[0] . '", "alert_code":"success"}';
            echo $json;
        }
    } else if ($service == "login") {
        $ADRESS   = "localhost";
        $USERNAME = "custom";
        $PASSWORD = "HelloWorld123!";
        $DBNAME   = "phishing";
        $mysqli = new mysqli($ADRESS, $USERNAME, $PASSWORD, $DBNAME) or die('{"response":"Service is currently not available!", "alert_code":"danger"}');
        //END MYSQL
        $email    = $decoded['email'];
        $password = $decoded['password'];
        $result = $mysqli->query("SELECT `user_id`, `email`, `password` FROM users WHERE email = '$email'") or die('{"response":"Service is currently not available!", "alert_code":"danger"}');
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $arrayresult = mysqli_fetch_array($result);
            if (password_verify($password, $arrayresult['password'])) {
                $json = '{"response":"Success! Welcome back ' . $arrayresult['email'] . '", "alert_code":"success"}';
                session_start();
                $_SESSION['loggedIn'] = '1';
                $_SESSION['user_id']  = $arrayresult['user_id'];
                echo $json;
                exit();
            } else {
                $json = '{"response":"Invalid Credentials!", "alert_code":"danger"}';
                echo $json;
            }
        } else {
            $json = '{"response":"Invalid Credentials!", "alert_code":"danger"}';
            echo $json;
        }
    } else if ($service == "register") {
        $ADRESS   = "localhost";
        $USERNAME = "custom";
        $PASSWORD = "HelloWorld123!";
        $DBNAME   = "phishing";
        $mysqli = new mysqli($ADRESS, $USERNAME, $PASSWORD, $DBNAME) or die('{"response":"Service is currently not available!", "alert_code":"danger"}');
        //END MYSQL
        $email      = $decoded['email'];
        $password   = $decoded['password'];
        $hashedpass = password_hash($password, PASSWORD_DEFAULT);
        $result = $mysqli->query("INSERT INTO users (email, password, ip) VALUES ('$email', '$hashedpass', '$ip')") or die($mysqli->error);
        $json = '{"response":"Success! ' . $email . ' has been added", "alert_code":"success"}';
        echo $json;
    } else if ($service == "addGroup") {
        $url         = '' . $base_url . '/api/groups/?api_key=' . $apikey;
        $groupName   = $decoded['groupName'];
        $emailTarget = $decoded['emailTarget'];
        $emailFname  = $decoded['emailFname'];
        $emailLname  = $decoded['emailLname'];
        $massAdd     = $decoded['massAdd'];
        $results     = array();
        if ($massAdd != '') {
            foreach (preg_split("/((\r?\n)|(\r\n?))/", $massAdd) as $line) {
                $splitted    = explode(':', $line);
                $firstName   = $splitted[0];
                $lastName    = $splitted[1];
                $email       = $splitted[2];
                $multiTarget = array(
                    "email" => $email,
                    "first_name" => $firstName,
                    "last_name" => $lastName,
                    "position" => ""
                );
                array_push($results, $multiTarget);
            }
        }
        if ($emailTarget != '' || !$emailFname != '' || !$emailLname != '') {
            $targets = array(
                "email" => $emailTarget,
                "first_name" => $emailFname,
                "last_name" => $emailLname,
                "position" => ""
            );
            array_push($results, $targets);
        }
        $arr    = array(
            "name" => $groupName,
            'targets' => $results
        );
        $result = json_encode($arr);
        $ch     = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => $result
        ));
        $response = curl_exec($ch);
        if ($response === FALSE) {
            die(curl_error($ch));
        }
        $responseData = json_decode($response, TRUE);
        //Receive message back from Server if error occured
        if (array_key_exists('message', $responseData)) {
            $json = '{"response":"' . $responseData['message'] . '", "alert_code":"danger"}';
            echo $json;
            return;
        } else {
            $result_name = $responseData['name'];
            $first_date  = $responseData['modified_date'];
            $result_date = explode("T", $first_date);
            $json        = '{"response":"Success! ' . $result_name . ' has been added! Last Modified: ' . $result_date[0] . '", "alert_code":"success"}';
            echo $json;
        }
    } else if ($service == "addCampaign") {
        $url             = '' . $base_url . '/api/campaigns/?api_key=' . $apikey;
        $nameCampaign    = $decoded['nameCampaign'];
        $emailTemplate   = $decoded['emailTemplate'];
        $landingTemplate = $decoded['landingTemplate'];
        $smtpConfig      = $decoded['smtpConfig'];
        $launchDate      = $decoded['launch_date'];
        $targetGroup     = $decoded['targetGroup'];
        $dripfeed        = $decoded['dripfeed'];
        
        $launchingDate = date('c', strtotime($launchDate));
        $emailTemp     = array(
            "name" => $emailTemplate
        );
        $landingTemp   = array(
            "name" => $landingTemplate
        );
        $smtpTemp      = array(
            "name" => $smtpConfig
        );
        $targetList    = array(
            "name" => $targetGroup
        );
        $arr           = array(
            "name" => $nameCampaign,
            'template' => $emailTemp,
            'url' => "https://34.241.71.67",
            'page' => $landingTemp,
            'smtp' => $smtpTemp,
            'launch_date' => $launchingDate,
            'send_by_date' => null,
            'groups' => array(
                $targetList
            )
        );
        $result        = json_encode($arr);
        $ch            = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => $result
        ));
        $response = curl_exec($ch);
        if ($response === FALSE) {
            die(curl_error($ch));
        }
        $responseData = json_decode($response, TRUE);
        //Receive message back from Server if error occured
        if (array_key_exists('message', $responseData)) {
            $json = '{"response":"' . $responseData['message'] . '", "alert_code":"danger"}';
            echo $json;
            return;
        } else {
            $result_name = $responseData['name'];
            $first_date  = $responseData['created_date'];
            $result_date = explode("T", $first_date);
            $json        = '{"response":"Success! ' . $result_name . ' has been added! Last Modified: ' . $result_date[0] . '", "alert_code":"success"}';
            echo $json;
        }
    //START DELETE SECTION
    } else if ($service == "getTemplate") {
        $idTemplate    = $decoded['idTemplate'];
        $url             = '' . $base_url . '/api/templates/' . $idTemplate . '?api_key=' . $apikey;
        $json = file_get_contents($url);
        echo $json;
        exit();
    }else if ($service == "updateTemplate") {
        $idTemplate    = $decoded['idTemplate'];
        $url             = '' . $base_url . '/api/templates/' . $idTemplate . '?api_key=' . $apikey;
        $json = '{"response":"Success! The ID is ' . $idTemplate . ' !", "alert_code":"success"}';
        echo $json;
        exit(); 
    } else if ($service == "deleteCampaign") {
        $idCampaign    = $decoded['campaignID'];
        $url             = '' . $base_url . '/api/campaigns/' . $idCampaign;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: '.$apikey.'')
        );
        $result = curl_exec($ch);
        curl_close($ch);
        $responseData = json_decode($result, TRUE);
        $json = '{"response":"' . $responseData['message'] . '", "alert_code":"info"}';
        echo $json;
        exit();
    }else if ($service == "deleteEmail") {
        $emailID    = $decoded['emailID'];
        $url             = '' . $base_url . '/api/templates/' . $emailID;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: '.$apikey.'')
        );
        $result = curl_exec($ch);
        curl_close($ch);
        $responseData = json_decode($result, TRUE);
        $json = '{"response":"' . $responseData['message'] . '", "alert_code":"info"}';
        echo $json;
        exit();
    }else if ($service == "deleteLanding") {
        $landingID    = $decoded['landingID'];
        $url             = '' . $base_url . '/api/pages/' . $landingID;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: '.$apikey.'')
        );
        $result = curl_exec($ch);
        curl_close($ch);
        $responseData = json_decode($result, TRUE);
        $json = '{"response":"' . $responseData['message'] . '", "alert_code":"info"}';
        echo $json;
        exit();
    } else if ($service == "deleteSMTP") {
        $smtpID    = $decoded['smtpID'];
        $url             = '' . $base_url . '/api/smtp/' . $smtpID;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: '.$apikey.'')
        );
        $result = curl_exec($ch);
        curl_close($ch);
        $responseData = json_decode($result, TRUE);
        $json = '{"response":"' . $responseData['message'] . '", "alert_code":"info"}';
        echo $json;
        exit();
    } else if ($service == "deleteTarget") {
        $targetID    = $decoded['targetID'];
        $url             = '' . $base_url . '/api/groups/' . $targetID;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: '.$apikey.'')
        );
        $result = curl_exec($ch);
        curl_close($ch);
        $responseData = json_decode($result, TRUE);
        $json = '{"response":"' . $responseData['message'] . '", "alert_code":"info"}';
        echo $json;
        exit();

    //END DELETE SECTION
    } else if ($service == "smtpCreate") {
        $url       = '' . $base_url . '/api/smtp/?api_key=' . $apikey;
        $name      = $decoded['name'];
        $interface = $decoded['interface_type'];
        $address   = $decoded['from_address'];
        $host      = $decoded['host'];
        $username  = $decoded['username'];
        $password  = $decoded['password'];
        $ignore    = $decoded['ignore_cert_errors'];
        $bool      = filter_var($ignore, FILTER_VALIDATE_BOOLEAN);
        $arr       = array(
            "name" => $name,
            "interface_type" => $interface,
            "from_address" => $address,
            "host" => $host,
            "username" => $username,
            "password" => $password,
            "ignore_cert_errors" => $bool
        );
        $ch        = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($arr)
        ));
        
        $response = curl_exec($ch);
        if ($response === FALSE) {
            die(curl_error($ch));
        }
        $responseData = json_decode($response, TRUE);
        //Receive message back from Server if error occured
        if (array_key_exists('message', $responseData)) {
            $json = '{"response":"' . $responseData['message'] . '", "alert_code":"danger"}';
            echo $json;
            return;
        } else {
            $result_name = $responseData['name'];
            $first_date  = $responseData['modified_date'];
            $result_date = explode("T", $first_date);
            $json        = '{"response":"Success! ' . $result_name . ' has been added! Last Modified: ' . $result_date[0] . '", "alert_code":"success"}';
            echo $json;
        }
    }
    //POST method requires a service identifier such as templateCreate,emailCreate etc.
    else {
        $json = '{"response":"No Service Identifier!", "alert_code":"danger"}';
        echo $json;
    }
}
//Only Accepts POST method
else {
    $json = '{"response":"POST Method Required", "alert_code":"danger"}';
    echo $json;
}
function get_client_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
?>