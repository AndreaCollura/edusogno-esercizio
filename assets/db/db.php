<?php
// Creo Connessione al database

$con = mysqli_connect("localhost", "root", "root", "db-esercizio");
// Controllo connessione
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
