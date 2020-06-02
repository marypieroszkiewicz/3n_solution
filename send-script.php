<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $message = $_POST["message"];
    $antiSpam = $_POST["honey"];

    // Catcha
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    $captcha = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    if (!$captcha) {
        echo json_encode(array('success' => 'false', 'message' => 'captacha error'));
        exit;
    }
    $secretKey = "6LfYcf8UAAAAANmOLIRH-D0j32FRZqrNjzFAoDDu";
    $ip = $_SERVER['REMOTE_ADDR'];

    // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array('secret' => $secretKey, 'response' => $captcha);

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $responseKeys = json_decode($response,true);
    header('Content-type: application/json');

    if (!$responseKeys["success"]) {
        echo json_encode(array('success' => 'false'));
        exit;
    }
    $mailToSend = "marketing@3ns.com.pl";

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

    header("Content-Type: application/json");
    echo json_encode($return);
}
