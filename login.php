<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css" />
</head>


<?php
require('assets/db/db.php');

if (isset($_POST['email'])) {
  // rimuovo backslashes
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($con, $email);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($con, $password);
  //controllo se utente già presente
  $query = "SELECT * FROM `utenti` WHERE email='$email' and password = '" . md5($password) . "'";
  $result = mysqli_query($con, $query) or die(mysqli_error($con));
  $rows = mysqli_num_rows($result);
  if ($rows == 1) {
    $_SESSION['email'] = $email;
    // reindirizza utente a index.php
    header("Location: index.php");
    exit();
  } else {
    echo "<div class='form'>
<h3>L'Email o la password non corrisponde!.</h3>
<br/>Clicca qui per il <a href='login.php'>Login</a></div>";
  }
} else {
?>
  <div class="form">
    <h1>Log In</h1>
    <form action="" method="post" name="login">
      <input type="email" name="email" placeholder="mariorossi@gmail.com" required />
      <input type="password" name="password" placeholder="Password" required />
      <input name="submit" type="submit" value="Login" />
    </form>
    <p>Non ancora registrato? <a href='register.php'>Registrati qui!</a></p>
  </div>
<?php } ?>


</html>