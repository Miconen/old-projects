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

$kirjat = NULL;
$sql = "SELECT * FROM dohtuproj_kirjasto_kirjat";
        $result = $db->query($sql);
        $kirjat = array();
        while ($row = $result->fetch()) {
            $kirjat[] = $row;
        };
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
        echo '<li class="currentPageLi"><a class="currentPage" href="kirjat.php">Kirjat</a></li>';
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
    <h1>Kirjat</h1>
    <?php
    if (isset($_SESSION['loggedin'])) {
        echo "<p>Kirjautunut käyttäjä: " . $_SESSION['role'] . " " . $_SESSION['loggedin'] . "</p>";
    };
    if(empty($kirjat)) {
        echo "Ei Kirjoja.";
    };
    if(!empty($kirjat)) {
    echo "<div class='table-border-div'>";
    echo "<table border>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Nimi</th>";
    echo "<th>Laji</th>";
    echo "<th>Vuosi</th>";
    echo "</tr>";
    foreach ($kirjat as $rivi) {
    extract($rivi);
    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>$nimi</td>";
    echo "<td>$laji</td>";
    echo "<td>$vuosi</td>";
    echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    };
    ?>
    </div>
</body>
</html>
