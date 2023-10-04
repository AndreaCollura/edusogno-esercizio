<?php
session_start();
include __DIR__ . '/assets/db/db.php';
//cancella sessione dai cookie
if (!isset($_SESSION['email'])) {
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
      session_name(),
      '',
      time() - 42000,
      $params["path"],
      $params["domain"],
      $params["secure"],
      $params["httponly"]
    );
  }
  session_destroy();

  header("Location: login.php");
}

//recupero nome sessione corrente
$sql = "SELECT `nome` FROM utenti WHERE `email` LIKE '%$_SESSION[email]%'; ";
$result = $con->query($sql);
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $_SESSION['nome'] = $row['nome'];
  }
} elseif ($result) {
  echo "no result";
} else {
  echo "query error";
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Admin page</title>
  <link rel="stylesheet" href="assets/styles/style.css" />
</head>

<body>
  <div class="form">
    <p>Ciao <?php echo $_SESSION['nome'] ?> !</p>
    <p><a href="events-admin.php">Lista eventi</a></p>
    <a href="logout.php">Logout</a>
  </div>
</body>

</html>