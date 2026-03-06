<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#0a0a0a">
  <meta http-equiv="refresh" content="2;url=login.php">
  <title>Signing Out | NOIR MAISON</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="logout-overlay active">
    <p>Until next time...</p>
  </div>
</body>
</html>
