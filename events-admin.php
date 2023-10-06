<?php
session_start();
include __DIR__ . '/assets/db/db.php';

$newSql = "SELECT `is_admin` FROM utenti WHERE `email` LIKE '%$_SESSION[email]%'; ";
$newResult = mysqli_query($con, $newSql);
if ($newResult) {
  $row = mysqli_fetch_assoc($newResult);
  $is_admin = $row['is_admin'];
  //var_dump($is_admin);
  if (!isset($_SESSION['email']) || $is_admin === NULL) {
    header("location: login.php");
  };
}

$mail = strval($_SESSION['email']);
//seleziono tutti gli eventi che contengono la mail di sessione
$sqlEvent = "SELECT * FROM `eventi`";
$result = $con->query($sqlEvent);

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/styles/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Event Admin Pannel</title>
</head>

<body>

  <?php include("./layouts/partials/header.php"); ?>


  <div class="wrapper">
    <div class="container-list">
      <?php
      if (isset($_GET["msg"])) {
        $msg = $_GET["msg"];
        echo '<p class="success-msg">
      ' . $msg . '
    </p>';
      }
      ?>
      <button class="addnew-btn"><a class="event-button" href="add-new.php">nuovo evento</a></button>
      <table class="style-table">
        <thead>
          <tr>
            <th scope="col">Utente</th>
            <th scope="col">nome evento</th>
            <th scope="col">data evento</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td><?php echo $row["attendees"] ?></td>
              <td><?php echo $row["nome_evento"] ?></td>
              <td><?php echo $row["data_evento"] ?></td>
              <td>
                <button class="edit-btn">
                  <a class="event-button" href="edit.php?id=<?php echo $row["id"] ?>" class=""><i class="fa-solid fa-pen-to-square"></i></a>
                </button>
                <button class="delete-btn">
                  <!-- richiesta conferma eliminazione -->
                  <?php
                  echo "<a onClick=\" javascript:return confirm(' Eliminare evento selezionato? '); \" class='event-button' href='delete.php?id={$row['id']}'><i class='fa-solid fa-trash '></i></a>"
                  ?>
                </button>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>