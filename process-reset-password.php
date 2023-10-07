<?php

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/assets/db/db-con.php";

$sql = "SELECT * FROM utenti
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
  die("Token non trovato");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
  die("Token scaduto");
}

if (strlen($_POST["password"]) < 8) {
  die("La password deve contenere almeno 8 caratteri");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
  die("La password deve contenere almeno una lettera!");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
  die("La password deve contenere almeno un numero!");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
  die("Le password devono combaciare!");
}

$password_hash = md5($_POST["password"]);


$sql = "UPDATE utenti
        SET password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("ss", $password_hash, $user["id"]);

$stmt->execute();



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/styles/style.css" />
  <title>Reset Password </title>
</head>

<body>

  <?php include("layouts/partials/header.php"); ?>
  <div class="wrapper">
    <div class="container">
      <h3>Password aggiornata con successo! Torna al <a href='login.php'>Login</a></h3>
      <button>
      </button>
      </form>
    </div>
  </div>
</body>

</html>