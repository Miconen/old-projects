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
if ($_SESSION['role'] == "admin") {
    header("Location: "."ilmoittautumiset.php");
    exit();
};

$nimi = $_SESSION["nimi"];
$userId = $_SESSION["id"];

$sql = "SELECT k.etunimi, k.sukunimi, k.email, l.numero, l.nimi " .
        "FROM ilmoittautuminen i " .
        "INNER JOIN kipailija k ON k.id = i.kilpailja " .
        "INNER JOIN laji l ON l.id = i.laji " .
        "WHERE l.valmentaja = '$userId'" .
        "ORDER BY l.numero, k.sukunimi, k.etunimi";

$result = $db->query($sql);

$ilmoittautuneet = array();
while ($row = $result->fetch()) {
    $ilmoittautuneet[] = $row;
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
        if($_SESSION['role'] == "user") {
            {
            echo '<li><a href="ilmoittautuminen.php">Ilmoittautuminen</a></li>';
            };
        };
    };
        if(isset($_SESSION['loggedin'])) {
            if($_SESSION['role'] == "admin") {
                {
                echo '<li><a href="ilmoittautumiset.php">Ilmoittautumiset</a></li>';
                };
            };
        };
        if(isset($_SESSION['loggedin'])) {
        if($_SESSION['role'] == "user") {
            {
            echo '<li><a href="ilmoittautumiseni.php">Ilmoittautumiseni</a></li>';
            };
        };
    };
        if(isset($_SESSION['loggedin'])) {
        if($_SESSION['role'] == "opettaja") {
            {
            echo '<li class="currentPageLi"><a class="currentPage" href="lajini.php">Lajini</a></li>';
            };
        };
    };
        if(!isset($_SESSION['loggedin'])) {
        {
        echo '<li><a href="login.php">Login</a></li>';
        };
    };
        if(!isset($_SESSION['loggedin'])) {
        {
        echo '<li><a href="register.php">Register</a></li>';
        };
    };
        if(isset($_SESSION['loggedin'])) {
        {
        echo '<li><a href="logout.php">Logout</a></li>';
        };
    };
        ?>
        </ul>
    </div>
</nav>
<div id="divBody" class="fixedWidth">
    <h1>Lajini</h1>
    <?php
    if (isset($_SESSION['loggedin'])) {
        echo "<p>Kirjautunut käyttäjä: " . $_SESSION['role'] . " " . $_SESSION['loggedin'] . "</p>";
    };
    //TEST ILMOITTAUTUNEET \/
    //$ilmoittautuneet = array();
    if(empty($ilmoittautuneet)) {
        echo "<p>Et ole ilmoittautunut lajeihin</p>";
        echo "<p><a href='ilmoittautuminen.php'>Ilmoittaudu täältä</a></p>";
    };
    if(!empty($ilmoittautuneet)) {
        echo "<table border>";
        echo "<tr>";
        echo "<th>Etunimi</th>";
        echo "<th>Sukunimi</th>";
        echo "<th>Email</th>";
        echo "<th>Laji</th>";
        echo "</tr>";
        foreach ($ilmoittautuneet as $rivi) {
        extract($rivi);
        echo "<tr>";
        echo "<td>$etunimi</td>";
        echo "<td>$sukunimi</td>";
        echo "<td>$email</td>";
        echo "<td>$numero $nimi</td>";
        echo "</tr>";
        }
        echo "</table>";
    };
    ?>
    </div>
</body>
</html>
