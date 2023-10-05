<!DOCTYPE html>
<html>

<head>
  <title>Forgot Password</title>
  <meta charset="UTF-8">
</head>

<body>

  <?php include("./layouts/partials/header.php"); ?>

  <h1>Recupero password</h1>

  <form method="post" action="send-password-reset.php">

    <label for="email">email</label>
    <input type="email" name="email" id="email">

    <button>Send</button>

  </form>

</body>

</html>