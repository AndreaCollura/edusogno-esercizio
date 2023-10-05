<?php
session_start();
include __DIR__ . '/assets/db/db.php';

if (!isset($_SESSION['email'])) {
  header("location: login.php");
};

$mail = strval($_SESSION['email']);
//seleziono tutti gli eventi che contengono la mail di sessione
$sql = "SELECT * FROM `eventi` WHERE `attendees` LIKE '%$mail%'; ";
$result = $con->query($sql);

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/styles/style.css" />
  <title>Event User Pannel</title>
</head>

<body>

  <?php include("./layouts/partials/header.php"); ?>


  <div class="wrapper">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <h1 class="wrapper-h1">Ciao <?php echo $_SESSION['nome'] ?> ecco i tuoi eventi !</h1>
    <div class="event-display">
      <?php
      while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <div class="container-event">
          <h2><?php echo $row["nome_evento"] ?></h2>
          <p><?php echo $row["data_evento"] ?></p>
          <button>join</button>
        </div>
      <?php
      }
      ?>
    </div>

  </div>


</body>

</html>