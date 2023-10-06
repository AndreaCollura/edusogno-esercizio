<?php

require('assets/db/db.php');
// se il form é inviato, inserisci valori nel database
if (isset($_REQUEST['email'])) {
  // rimuovi backslashes

  $errors = array();
  $name = stripslashes($_REQUEST['nome']);
  $surname = stripslashes($_REQUEST['cognome']);
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($con, $email);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($con, $password);

  $sql = "SELECT * FROM utenti WHERE email='$email' LIMIT 1";

  $res = mysqli_query($con, $sql);

  if (mysqli_num_rows($res) > 0) {

    $row = mysqli_fetch_assoc($res);
    if ($email == isset($row['email'])) {
      header("Location: email-error.php");
      exit();
    }
  } else {
    $query = "INSERT into `utenti` (nome, cognome, password, email)
VALUES ('$name', '$surname', '" . md5($password) . "', '$email')";
    $newRes = mysqli_query($con, $query);

    header("Location: register-success.php");
    exit();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/styles/style.css" />
  <title>Registrazione Utente</title>
</head>

<body>

  <?php include("./layouts/partials/header.php"); ?>


  <div class="wrapper">
    <h1 class="wrapper-h1">Crea il tuo account</h1>
    <div class="container">
      <form name="registration" action="" method="post">
        <label class="form__label" for="nome">Inserisci nome</label>
        <input class="form__field" type="nome" name="nome" placeholder="mario" required />
        <label class="form__label" for="cognome">Inserisci cosgnome</label>
        <input class="form__field" type="cognome" name="cognome" placeholder="rossi" required />
        <label class="form__label" for="email">Inserisci l'email</label>
        <input class="form__field" type="email" name="email" placeholder="mariorossi@gmail.com" required />
        <label class="form__label" for="password">Inserisci la password</label>
        <input class="form__field" type="password" name="password" placeholder="Password" required />
        <button name="submit" type="submit" value="register">RIGISTRATI</button>
      </form>
      <p>Hai già un account? <a href='register.php'>Accedi!</a></p>


    </div>

  </div>
</body>

</html>