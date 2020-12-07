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

$nimi = $laji = $vuosi = NULL;

//VALIDOINTI
filter_input(INPUT_POST, 'submit');
if (isset($_POST['submit'])){

  var_dump($_POST);

  $nimi = filter_input(INPUT_POST, 'nimi', FILTER_SANITIZE_STRING);
  $laji = filter_input(INPUT_POST, 'laji', FILTER_SANITIZE_STRING);
  $vuosi = filter_input(INPUT_POST, 'vuosi', FILTER_SANITIZE_NUMBER_INT);

  if (!isset($nimi)) {
    $errorMsg = "Lisää Kirjan Nimi!";
  }

  if (!isset($laji)) {
    $errorMsg = "Lisää Kirjan Laji!";
  }
  if (!isset($vuosi)) {
    $errorMsg = "Lisää Kirjan Julkaisuvuosi!";
  }
var_dump($errorMsg);
  if(empty($errorMsg)) {

      $sql = "INSERT INTO dohtuproj_kirjasto_kirjat (nimi, laji, vuosi) VALUES(?, ?, ?)";
          $db = getDbObject();
          $statement = $db->prepare($sql);
          $statement->execute(array($nimi,$laji,$vuosi));
          $user = $statement->fetch();

      $redirectTo = "Location: thankyou.php?nimi='$nimi'";
      header($redirectTo);
  }
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
            echo '<li class="currentPageLi"><a class="currentPage" href="lisaakirja.php">Lisää Kirja</a></li>';
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
    <h1>Lisää Kirja</h1>
    <?php
    if (isset($_SESSION['loggedin'])) {
        echo "<p>Kirjautunut käyttäjä: " . $_SESSION['role'] . " " . $_SESSION['loggedin'] . "</p>";
    };
    ?>
    <form method="post">
    <p>
        <label for="osoite">Kirjan Nimi: </label>
        <input type="text" name="nimi">
    </p>
    <p>
        <label for="posti">Kirjan Laji: </label>
        <input type="text" name="laji">
    </p>
    <p>
        <label for="toimipaikka">Kirjan Julkaisuvuosi: </label>
        <input type="number" name="vuosi">
    </p>
    <button name="submit" value="lisaa">Lisää</button>
</form>
</div>
</body>
</html>
