<?php
include __DIR__ . '/assets/db/db.php';

if (isset($_POST["submit"])) {
  $attendees = $_POST['attendees'];
  $nomeEvento = $_POST['nome_evento'];
  $dataEvento = $_POST['data_evento'];

  var_dump($date);

  $sql = "INSERT INTO `eventi`(`id`,`attendees`, `nome_evento`, `data_evento`) VALUES (NULL,'$attendees','$nomeEvento','$dataEvento')";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: events-admin.php?msg=Nuovo evento creato con successo!");
  } else {
    echo "Failed: " . mysqli_error($con);
  }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/styles/style.css" />
  <title>Nuovo Evento</title>
</head>

<body>

  <?php include("layouts/partials/header.php"); ?>


  <div class="wrapper">
    <h1 class="wrapper-h1">Crea nuovo evento</h1>
    <div class="container">
      <form action="" method="POST">
        <label class="form-label">mail studente</label>
        <input class="form__field" type="email" name="attendees" placeholder="Studenti">
        <label class="form-label">Nome Evento</label>
        <input class="form__field" type="text" name="nome_evento" placeholder="nome evento">
        <label class="form-label">First Name:</label>
        <input class="form__field" type="datetime-local" name="data_evento" placeholder="data evento" value="2018-06-12T19:30" min="2018-06-07T00:00" max="2050-06-14T00:00">

        <button type="submit" name="submit">SALVA</button>
        <button>
          <a href="index-admin.php" class="event-button">Cancel</a>
        </button>
      </form>

    </div>

  </div>
</body>


<body>




</body>

</html>