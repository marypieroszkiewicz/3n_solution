<?php

define("RECAPTCHA_V3_SECRET_KEY", '6LfG6P4UAAAAAPByReQYcP4ZQabBRjUrxon9fp45');

if (isset($_POST['email']) && $_POST['email']) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
} else {
    // set error message and redirect back to form...
    header('location: send-script.php');
    exit;
}

$token = $_POST['token'];
$action = $_POST['action'];

// call curl to POST request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$arrResponse = json_decode($response, true);

// verify the response
if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
    // valid submission
    // go ahead and do necessary stuff
} else {
    // spam submission
    // show error message
}


$mailToSend = "marketing@3ns.com.pl";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $antiSpam = $_POST["honey"];

    $errors = Array();
	$return = Array();

	if (empty($name)) { //jeżeli pusta wartość
        array_push($errors, "name");
    }
    if (empty($name)) {
            array_push($errors, "surname");
        }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //sprawdzamy czy email ma zły wzór
        array_push($errors, "email");
    }
    if (empty($message)) {
        array_push($errors, "message");
    }
    if (empty($antiSpam)) {

    if (count($errors) > 0) {
        $return["errors"] = $errors;
    } else {
        //każde wysłanie wiadomości musi być poprzedzone ustawieniem nagłówków
        $headers  = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8". "\r\n";
        $headers .= "From: ".$email."\r\n";
        $headers .= "Reply-to: ".$email;
        $message  = "
            <html>
                <head>
                    <meta charset=\"utf-8\">
                </head>
                <body>
                    <div> Imię: $name</div>
                    <div> Nazwisko: $surname</div>
                    <div> Email: <a href=\"mailto:$email\">$email</a> </div>
                    <div> Telefon kontaktowy: $phone </div>
                    <div> Wiadomość: </div>
                    <div> $message </div>
                </body>
            </html>";

        if (mail($mailToSend, "Wiadomosc ze strony - 3N SOLUTIONS " . date("d-m-Y"), $message, $headers)) {
            $return["status"] = "ok";
        } else {
            $return["status"] = "error";
        }
    }

    } else {
        $return["status"] = "ok";
    }

    header("Content-Type: application/json");
    echo json_encode($return);
}