<?php
include("auth.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome Home</title>
    <link rel="stylesheet" href="assets/styles/style.css" />
</head>

<body>
    <div class="form">
        <p>Benvenuto <?php echo $_SESSION['email']; ?>!</p>
        <!-- work in progress -->
        <p>Lista eventi</p>
        <p><a href="dashboard.php">Dashboard</a></p>
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>