<?php

$host = "localhost";
$dbname = "db-esercizio";
$username = "root";
$password = "root";

$mysqli = new mysqli(
  hostname: $host,
  username: $username,
  password: $password,
  database: $dbname
);

if ($mysqli->connect_errno) {
  die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
