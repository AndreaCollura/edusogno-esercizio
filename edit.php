<?php
include __DIR__ . '/assets/db/db.php';
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $attendees = $_POST['attendees'];
  $nome_evento = $_POST['nome_evento'];
  $data_evento = $_POST['data_evento'];

  $sql = "UPDATE `eventi` SET `attendees`='$attendees',`nome_evento`='$nome_evento',`data_evento`='$data_evento' WHERE id = $id";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: events-admin.php?msg=Data updated successfully
    ");
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
  <title>Modifica Evento</title>
</head>

<body>


  <?php include("./layouts/partials/header.php"); ?>

  <?php
  $sql = "SELECT * FROM `eventi` WHERE id = $id LIMIT 1";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  ?>


  <div class="wrapper">
    <h1 class="wrapper-h1">modifica evento</h1>
    <div class="container">

      <form action="" method="POST">
        <label class="form__label">mail studente</label>
        <textarea class="form__field" type="text" name="attendees" placeholder="Studenti"><?php echo $row['attendees'] ?></textarea>
        <label class="form__label">Nome Evento</label>
        <input class="form__field" type="text" name="nome_evento" placeholder="nome evento" value="<?php echo $row['nome_evento'] ?>">

        <label class="form__label">data evento</label>
        <input class="form__field" type="datetime-local" name="data_evento" placeholder="data evento" value="<?php echo $row['data_evento'] ?>">

        <button type="submit" name="submit">SALVA</button>
        <button>
          <a class="event-button" href="events-admin.php">Cancel</a>
        </button>
      </form>
    </div>

  </div>











</body>


</html>