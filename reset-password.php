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
  die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
  die("token has expired");
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="/assets/js/validation.js" defer></script>
  <title>reset password</title>
</head>

<body>

  <?php include("./layouts/partials/header.php"); ?>

  <h1>Reset Password</h1>

  <form method="post" action="process-reset-password.php">

    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

    <label for="password">Nuova password</label>
    <input type="password" id="password" name="password">

    <label for="password_confirmation">ripeti password</label>
    <input type="password" id="password_confirmation" name="password_confirmation">

    <button>invia</button>
  </form>
</body>

</html>