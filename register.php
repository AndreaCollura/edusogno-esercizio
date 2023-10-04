<?php

require('assets/db/db.php');
// se il form é inviato, inserisci valori nel database
if (isset($_REQUEST['email'])) {
  // rimuovi backslashes
  $name = stripslashes($_REQUEST['nome']);
  $surname = stripslashes($_REQUEST['cognome']);
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($con, $email);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($con, $password);
  $query = "INSERT into `utenti` (nome, cognome, password, email)
VALUES ('$name', '$surname',  '" . md5($password) . "', '$email')";
  $result = mysqli_query($con, $query);
  if ($result) {
    header("Location: register-success.php");
  }
} else {
?>
  <div class="form">
    <h1>Registration</h1>
    <form name="registration" action="" method="post">
      <input type="text" name="nome" placeholder="Mario" required />
      <input type="text" name="cognome" placeholder="Rossi" required />
      <input type="email" name="email" placeholder="mariorossi@gmail.com" required />
      <input type="password" name="password" placeholder="Password" required />
      <input type="submit" name="submit" value="Register" />
    </form>
  </div>
<?php } ?>