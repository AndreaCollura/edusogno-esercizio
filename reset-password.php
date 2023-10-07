<?php

$token = $_GET["token"];

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
    <h1 class='wrapper-h1'>Inserisci nuova password</h1>
    <div class="container">
      <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label class="form__label" for="password">Nuova password</label>
        <input class="form__field" type="password" id="password" name="password">

        <label class="form__label" for="password_confirmation">ripeti password</label>
        <input class="form__field" type="password" id="password_confirmation" name="password_confirmation">

        <button>invia</button>
      </form>
    </div>
  </div>
</body>

</html>