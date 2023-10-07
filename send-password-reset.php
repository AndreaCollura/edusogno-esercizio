<?php

require('assets/db/db.php');

$email = $_POST["email"];


$sql = "SELECT * FROM utenti WHERE email='$email' LIMIT 1";


$res = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($res);

if ($email !== $row['email']) {
  var_dump(isset($row['email']));
  header("Location: reset-pass-error.php");
  exit();
} else {

  $token = bin2hex(random_bytes(16));

  $token_hash = hash("sha256", $token);

  $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

  $mysqli = require __DIR__ . "/assets/db/db-con.php";

  $sql = "UPDATE utenti SET reset_token_hash =?, reset_token_expires_at =? WHERE email =?";


  $stmt = $mysqli->prepare($sql);

  $stmt->bind_param("sss", $token_hash, $expiry, $email);

  $stmt->execute();

  if ($mysqli->affected_rows) {

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Clicca <a href="http://localhost/edusogno-esercizio/reset-password.php?token=$token">qui</a> 
    per resettare la tua password.

    END;

    try {

      $mail->send();
    } catch (Exception $e) {

      echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }
  }

  echo

  "<!DOCTYPE html>
  <html lang='en'>
  
  <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='assets/styles/style.css' />
    <title>Document</title>
  </head>
  
  
  <body>
  
  " .  (include("./layouts/partials/header.php")) .  "
  
    <div class='wrapper'>
      <h1 class='wrapper-h1'>Mail inviata, per favore controlla la tua mailbox.</h1>
      <div class='container'>
        <div>
          <p>Clicca qui per il <a href='login.php'>login!</a></p>
        </div>
      </div>
    </div>
  </body>
  
  </html>";
}
