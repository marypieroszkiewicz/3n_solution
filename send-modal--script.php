<?php

function post($url, $data = "", $headers = []) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_POST, 1);
    $result = curl_exec($ch);
    curl_close($result);
    return json_decode($result);
}

function verify_captcha($token) {
    $secret = "6Ldzev8UAAAAAOQgCxjcx-gFHPd9i3KOzmaVO32a";
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = "secret=" . $secret . "&response=" . $token;
    return post($url, $data, array('Content-type: application/x-www-form-urlencoded;charset=UTF-8'));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $antiSpam = $_POST["honey"];

    // Catcha
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $token = $_POST["token"];
    header('Content-type: application/json');
    $captcha = verify_captcha($token);
    if (!$captcha->success) {
        echo json_encode(array('success' => 'false'));
        exit;
    }

    $mailToSend = "marketing@3ns.com.pl";


    $errors = Array();
	$return = Array();

	    if (empty($name)) { //jeżeli pusta wartość
            array_push($errors, "name");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //sprawdzamy czy email ma zły wzór
            array_push($errors, "email");
        }
        if (!empty($antiSpam)) {
            array_push($errors, "antiSpam");
        }
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
                        <div> Email: <a href=\"mailto:$email\">$email</a> </div>
                    </body>
                </html>";

            if (mail($mailToSend, "Wiadomosc ze strony - 3N SOLUTIONS -- OFERTA " . date("d-m-Y"), $message, $headers)) {
                $return["success"] = "true";
            } else {
                $return["success"] = "false";
            }
        }

    header("Content-Type: application/json");
    echo json_encode($return);
}