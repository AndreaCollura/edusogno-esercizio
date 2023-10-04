<?php

$email = $_POST["email"];

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

echo "Mail inviata, per favore controlla la tua mailbox.";
