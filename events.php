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
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "nome " . $row['nome_evento'] . " data: " . $row['data_evento'];
  }
} elseif ($result) {
  echo "no result";
} else {
  echo "query error";
}
