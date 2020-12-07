<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=utf-8');
require('utility.php');
require('error.php');
$db = getDbObject();
session_start();
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
        <li class="currentPageLi"><a class="currentPage" href="index.php">Etusivu</a></li>
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
    <h1>Online Kirjasto</h1>

    <?php
    if (isset($_SESSION['loggedin'])) {
        echo "<p>Kirjautunut käyttäjä: " . $_SESSION['role'] . " " . $_SESSION['loggedin'] . "</p>";
    };
    ?>
    <img src="img/background4.png" alt="">
    <h3>Rekisteröinti / Kirjautuminen on pakollista jotta voimme myydä tietosi.</h3>
    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla mi quam, interdum ac auctor eu, varius ac enim. Donec condimentum faucibus risus quis blandit. Pellentesque eu quam est. Proin enim urna, lobortis ut vestibulum eget, finibus eget ex. Nam non faucibus lacus. Aliquam lacus diam, dictum ac vestibulum nec, hendrerit at libero. Fusce a orci eu nunc volutpat porta. Nam erat orci, eleifend vitae pellentesque id, molestie vitae ipsum. Suspendisse faucibus fringilla lorem vel maximus. Cras aliquam vestibulum mi. In augue neque, pharetra sit amet cursus ut, aliquet at lectus. Quisque risus mauris, sagittis eu nulla sed, eleifend pharetra magna. </p>

  <p>  Aenean tincidunt molestie vestibulum. Pellentesque turpis sem, efficitur eget varius ac, ultricies quis lacus. Integer nec nulla non arcu tempus sagittis sed a nibh. Nam ut condimentum ipsum. Vestibulum gravida a lorem porta suscipit. Donec in dui eu nisi condimentum convallis ut vel elit. Proin finibus vitae nulla eu ultricies. In hac habitasse platea dictumst. Vestibulum tristique ultrices nunc et aliquet. Suspendisse a vehicula nisl. Curabitur efficitur, sem in cursus blandit, orci enim lacinia diam, quis molestie sem sem eu augue. </p>

   <p> Ut eu est sit amet odio egestas vehicula. Nam id lacus viverra, ultricies mauris ac, placerat lacus. Curabitur molestie auctor urna, nec imperdiet leo mattis id. Aenean feugiat euismod risus, quis scelerisque nunc imperdiet vel. Mauris pretium faucibus eros eget pretium. Nunc efficitur, mauris in fermentum posuere, nulla nisl mattis neque, lacinia tristique ipsum erat quis lacus. Duis non feugiat nulla. Vestibulum placerat quam vitae felis iaculis, ut elementum sapien iaculis. </p>

  <p>  Vivamus in ligula vel purus dictum porta eget a turpis. Ut id fermentum nisi, sit amet feugiat risus. Nunc molestie tortor vitae lectus auctor laoreet. Curabitur maximus in metus at mollis. Phasellus maximus justo tincidunt ante elementum, at ultricies nisi ultricies. Suspendisse arcu diam, gravida quis lorem ac, posuere lobortis velit. Mauris interdum magna sed ligula interdum, vel auctor justo pharetra. Duis sed imperdiet nulla. Pellentesque malesuada arcu non dictum tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed nisi diam, sollicitudin ut scelerisque vel, ultrices a erat. Nam accumsan magna ipsum, sed congue mauris facilisis quis. Sed id est erat. Curabitur semper vehicula tempus. </p>

   <p> Nulla sollicitudin vehicula mi, non laoreet eros. Nam vestibulum arcu odio, nec porttitor augue rutrum facilisis. Aliquam a euismod mi. Vivamus tempus libero eu justo molestie egestas. In tempor nec dui sit amet aliquet. Fusce aliquam hendrerit orci sed tempus. Mauris ac urna vulputate, sodales purus suscipit, faucibus tellus. Integer feugiat scelerisque tempor. Suspendisse nisl diam, semper quis lorem eu, vehicula ullamcorper velit. Curabitur fringilla varius elementum. Donec ut dignissim nulla. Phasellus vitae erat justo. Fusce metus arcu, blandit ut euismod sed, imperdiet vel magna. Suspendisse iaculis tincidunt aliquet. Sed sollicitudin lacus sed nisi cursus, eget suscipit libero fringilla. </p>
</div>
</body>
</html>
