<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=utf-8');
require('utility.php');
require('error.php');
$db = getDbObject();
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: "."index.php");
    exit();
};
if ($_SESSION['role'] !== "admin") {
    header("Location: "."index.php");
    exit();
};

$id = $_GET['id'];
$laji = $_GET['laji'];

$sql = "SELECT k.id, k.etunimi, k.sukunimi, k.puhelin, k.email, k.osoite, k.postinumero, k.postitoimipaikka, k.syntymaaika, k.erityisruokavalio, k.kuvauslupa, l.numero, l.nimi " .
        "FROM ilmoittautuminen i " .
        "INNER JOIN kipailija k ON k.id = i.kilpailja " .
        "INNER JOIN laji l ON l.id = i.laji " .
        "WHERE i.kilpailja = '$id' AND l.numero = '$laji'" .
        "ORDER BY l.numero, k.sukunimi, k.etunimi";
$result = $db->query($sql);

$ilmoittautuneet = array();
while ($row = $result->fetch()) {
    $ilmoittautuneet[] = $row;
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
        if($_SESSION['role'] == "user") {
            {
            echo '<li><a href="ilmoittautuminen.php">Ilmoittautuminen</a></li>';
            };
        };
    };
        if(isset($_SESSION['loggedin'])) {
            if($_SESSION['role'] == "admin") {
                {
                echo '<li class="currentPageLi"><a class="currentPage" href="ilmoittautumiset.php">Ilmoittautumiset</a></li>';
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
            echo '<li"><a href="lajini.php">Lajini</a></li>';
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
    <h1>View Mode for <?php echo $id . " " . $ilmoittautuneet[0]['nimi'];?></h1>
    <?php
    if ($_SESSION['role'] == "admin") {
        echo "<p>Kirjautunut käyttäjä: " . $_SESSION['role'] . " " . $_SESSION['loggedin'] . "</p>";
    };
    if(!empty($ilmoittautuneet)) {
    //UPPER TABLE
    echo "<div class='table-border-div'>";
    echo "<table border>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Etunimi</th>";
    echo "<th>Sukunimi</th>";
    echo "<th>Laji</th>";
    echo "<th>Puhelin</th>";
    echo "<th>Email</th>";
    echo "</tr>";
    foreach ($ilmoittautuneet as $rivi) {
    extract($rivi);
    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>$etunimi</td>";
    echo "<td>$sukunimi</td>";
    echo "<td>$numero $nimi</td>";
    echo "<td>$puhelin</td>";
    echo "<td>$email</td>";
    echo "</tr>";
    }
    //LOWER TABLE
    echo "</table>";
    echo "</div>";
    echo "<div class='table-border-div'>";
    echo "<table border>";
    echo "<tr>";
    echo "<th>Osoite</th>";
    echo "<th>Posti</th>";
    echo "<th>Syntymä-aika</th>";
    echo "<th>Kuvauslupa</th>";
    echo "<th>Ruokavalio</th>";
    echo "</tr>";
    foreach ($ilmoittautuneet as $rivi) {
    extract($rivi);
    echo "<tr>";
    echo "<td>$osoite</td>";
    echo "<td>$postinumero $postitoimipaikka</td>";
    echo "<td>$syntymaaika</td>";
    if ($kuvauslupa == 0) {
      $kuvauslupa = "Ei";
    }
    else {
      $kuvauslupa = "Kyllä";
    };
    echo "<td>$kuvauslupa</td>";
    echo "<td>$erityisruokavalio</td>";
    echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    };
    ?>
    </div>
    ?>
    </div>
</body>
</html>
