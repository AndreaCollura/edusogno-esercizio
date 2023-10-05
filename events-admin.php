<?php
session_start();
include __DIR__ . '/assets/db/db.php';

$newSql = "SELECT `is_admin` FROM utenti WHERE `email` LIKE '%$_SESSION[email]%'; ";
$newResult = mysqli_query($con, $newSql);
if ($newResult) {
  $row = mysqli_fetch_assoc($newResult);
  $is_admin = $row['is_admin'];
  var_dump($is_admin);
  if (!isset($_SESSION['email']) || $is_admin === NULL) {
    header("location: login.php");
  };
}

$mail = strval($_SESSION['email']);
//seleziono tutti gli eventi che contengono la mail di sessione
$sql = "SELECT * FROM `eventi`";
$result = $con->query($sql);

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Event Admin Pannel</title>
</head>

<body>
  <div class="">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <a href="./layouts/admin-CRUD/add-new.php" class="">nuovo evento</a>
    <table class="">
      <thead class="">
        <tr>
          <th scope="col">Studente</th>
          <th scope="col">nome evento</th>
          <th scope="col">data evento</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `eventi`";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["attendees"] ?></td>
            <td><?php echo $row["nome_evento"] ?></td>
            <td><?php echo $row["data_evento"] ?></td>
            <td>
              <a href="./layouts/admin-CRUD/edit.php?id=<?php echo $row["id"] ?>" class="">edit</a>
              <a href="./layouts/admin-CRUD/delete.php?id=<?php echo $row["id"] ?>" class="">delete</a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>


</body>

</html>