<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=utf-8');
require('utility.php');
$db = getDbObject();
session_start();

if (!isset($_SESSION['loggedin'])) {
  header("Location: "."index.php");
  exit();
};

if ($_SESSION['role'] !== 'admin') {
  header("Location: "."index.php");
  exit();
}

if(!isset($_GET)){
   header('Location: '.'index.php');
   exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
<nav id="navBar">
  <div class="fixedWidth">
      <ul>
      <li><a href="index.php">Etusivu</a></li>
      <?php
      if(isset($_SESSION['loggedin'])) {
      echo '<li><a href="kirjat.php">Kirjat</a></li>';
      };
      if(!isset($_SESSION['loggedin'])) {
      echo '<li><a href="login.php">Login</a></li>';
      };
      if(!isset($_SESSION['loggedin'])) {
      echo '<li><a href="register.php">Register</a></li>';
      };
	  if(isset($_SESSION['loggedin'])) {
        if($_SESSION['role'] == "admin") {
          echo '<li><a href="lisaakirja.php">Lisää Kirja</a></li>';
        }
      };
      if(isset($_SESSION['loggedin'])) {
      echo '<li><a href="logout.php">Logout</a></li>';
      };
      ?>
      </ul>
  </div>
</nav>

<div id="divBody" class="fixedWidth">
    <h1>Kirja Lisätty!</h1>
    <?php
      echo 'Kirja ' . htmlspecialchars($_GET["nimi"]) . ' lisätty!';
    ?>
</div>
</body>
</html>
