<?php
session_start();


require('assets/db/db.php');

if (isset($_POST['email'])) {
  // rimuovo backslashes
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($con, $email);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($con, $password);
  $newPassword = md5($password);
  $query = "SELECT * FROM `utenti` WHERE email='$email' and password = '" . $newPassword . "'";
  $result = mysqli_query($con, $query) or die(mysqli_error($con));
  $rows = mysqli_num_rows($result);


  if ($rows == 1) {
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $_SESSION['email'] = $email;
        $newSql = "SELECT `is_admin` FROM utenti WHERE `email` LIKE '%$_SESSION[email]%'; ";
        $newResult = mysqli_query($con, $newSql);
        if ($newResult) {
          $row = mysqli_fetch_assoc($newResult);
          $is_admin = $row['is_admin'];
        }
        if ($is_admin) {
          $_SESSION['email'] = $email;
          $is_admin = $row['is_admin'];
          // reindirizza utente a index-admin.php
          header("Location: index-admin.php");
          exit();
        } else {
          $_SESSION['email'] = $email;
          // reindirizza utente a index.php
          header("Location: index.php");
          exit();
        }
      }
    } elseif ($result) {
      echo "no result";
    } else {
      echo "query error";
    }
  } else {
    header("Location: login-error.php");
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
  <title>Document</title>
</head>



<body>

  <?php include("./layouts/partials/header.php"); ?>

  <div class="wrapper">
    <h1 class="wrapper-h1">Hai già un account?</h1>
    <div class="container">
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" name="login">
        <label class="form__label" for="email">Inserisci l'email</label>
        <input class="form__field" type="email" name="email" placeholder="mariorossi@gmail.com" required />
        <label class="form__label" for="password">Inserisci la password</label>
        <input class="form__field" type="password" name="password" placeholder="Password" required />
        <button name="submit" type="submit" value="Login">ACCEDI</button>
      </form>
      <p>Non ancora registrato? <a href='register.php'>Registrati qui!</a></p>
      <a href="forgot-password.php">Password dimenticata?</a>

    </div>

  </div>

</body>

</html>