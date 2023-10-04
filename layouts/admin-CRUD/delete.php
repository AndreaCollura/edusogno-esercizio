<?php
include __DIR__ . '../../../assets/db/db.php';
$id = $_GET["id"];
$sql = "DELETE FROM `eventi` WHERE id = $id";
$result = mysqli_query($con, $sql);

if ($result) {
  header("Location: ../../events-admin.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($con);
}
