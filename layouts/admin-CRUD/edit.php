<?php
include __DIR__ . '../../../assets/db/db.php';
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $attendees = $_POST['attendees'];
  $nome_evento = $_POST['nome_evento'];
  $data_evento = $_POST['data_evento'];

  $sql = "UPDATE `eventi` SET `attendees`='$attendees',`nome_evento`='$nome_evento',`data_evento`='$data_evento' WHERE id = $id";

  $result = mysqli_query($con, $sql);

  if ($result) {
    header("Location: ../../events-admin.php?msg=Data updated successfully
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
  <title>Modifica Evento</title>
</head>

<body>


  <?php
  $sql = "SELECT * FROM `eventi` WHERE id = $id LIMIT 1";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  ?>



  <form action="" method="POST">
    <label class="form-label">mail studente</label>
    <input type="text" name="attendees" placeholder="Studenti" value="<?php echo $row['attendees'] ?>">

    <label class="form-label">Nome Evento</label>
    <input type="text" name="nome_evento" placeholder="nome evento" value="<?php echo $row['nome_evento'] ?>">

    <label class="form-label">First Name:</label>
    <input type="datetime-local" name="data_evento" placeholder="data evento" value="<?php echo $row['data_evento'] ?>">

    <button type="submit" name="submit">Save</button>
    <a href="../../events-admin.php" class="">Cancel</a>
  </form>

</body>


</html>