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
    <h1 class="wrapper-h1">recupero password</h1>
    <div class="container">
      <form method="post" action="send-password-reset.php">
        <label class="form__label" for="email">email</label>
        <input class="form__field" type="email" name="email" id="email">
        <button class="event-button">invia</button>
      </form>
    </div>
  </div>


</body>

</html>