<?php

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