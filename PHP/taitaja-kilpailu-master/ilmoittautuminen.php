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

//VALIDOINTI
if (filter_input(INPUT_POST, 'submit')) {
/*$etunimi = filter_input(INPUT_POST, 'etunimi', FILTER_SANITIZE_STRING);
$sukunimi = filter_input(INPUT_POST, 'sukunimi', FILTER_SANITIZE_STRING);
$puhelin = filter_input(INPUT_POST, 'puhelin', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);*/
$laji = filter_input(INPUT_POST, 'laji', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY);
$osoite = filter_input(INPUT_POST, 'osoite', FILTER_SANITIZE_STRING);
$postinumero = filter_input(INPUT_POST, 'postinumero', FILTER_SANITIZE_STRING);
$postitoimipaikka = filter_input(INPUT_POST, 'postitoimipaikka', FILTER_SANITIZE_STRING);
$syntymaaika = filter_input(INPUT_POST, 'syntymaaika', FILTER_SANITIZE_NUMBER_INT);
$erityisruokavalio = filter_input(INPUT_POST, 'erityisruokavalio', FILTER_SANITIZE_STRING);
$kuvauslupa = filter_input(INPUT_POST, 'kuvauslupa', FILTER_SANITIZE_NUMBER_INT);

    /*if (!$etunimi) {
    $errorMsg[] = "Syötä etunimesi";
    }
    if (!$sukunimi) {
    $errorMsg[] = "Syötä etunimesi";
    }
    if (!$email || !preg_match("/^\S+@\S+$/", $email)) {
    $errorMsg[] = "Syötä oikea sähköpostiosoitteesi";
  }*/
    if (!$laji) {
    $errorMsg[] = "Valitse vähintään yksi laji";
    }
    if(empty($errorMsg)) {
        $sessionName = $_SESSION['nimi'];
        $sql = "SELECT etunimi, sukunimi, email, puhelin FROM kayttaja WHERE etunimi = '$sessionName'";
        $result = $db->query($sql);

        $ilmoittautuneet = array();
        while ($row = $result->fetch()) {
            $ilmoittautuneet[] = $row;
        };
        extract($ilmoittautuneet[0]);

        $sql = "INSERT INTO kipailija (etunimi, sukunimi, puhelin, email, osoite, postinumero, postitoimipaikka, syntymaaika, erityisruokavalio, kuvauslupa)"
            . "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $db->prepare($sql);
        $statement->execute(array($etunimi, $sukunimi, $puhelin, $email, $osoite, $postinumero, $postitoimipaikka, $syntymaaika, $erityisruokavalio, $kuvauslupa));

        $kilpailija_id = $db->LastInsertId();
        foreach ($laji AS $l) {
            $sql = "INSERT INTO ilmoittautuminen (kilpailja, laji)"
                . "VALUES(?, ?)";
                $statement = $db->prepare($sql);
                $statement->execute(array($kilpailija_id, $l));
        }

        $nimi = "$etunimi $sukunimi";
        $urllajit = "";
        foreach ($laji AS $l) {
          $urllajit.= "&lajit[]=" . urlencode($l);
        }

        $redirectTo = "Location: thankyou.php?nimi=" . urlencode($nimi) . $urllajit;
        header($redirectTo);
    }
}

$result = $db->query('SELECT id, numero, nimi FROM laji');
while($row = $result->fetch()) {
    $laji[] = $row;
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
            echo '<li class="currentPageLi"><a class="currentPage" href="ilmoittautuminen.php">Ilmoittautuminen</a></li>';
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
            echo '<li><a href="lajini.php">Lajini</a></li>';
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
    <h1>Ilmoittaudu Taitaja-kilpailuun</h1>
    <?php
    if (isset($_SESSION['loggedin'])) {
        echo "<p>Kirjautunut käyttäjä: " . $_SESSION['role'] . " " . $_SESSION['loggedin'] . "</p>";
    };
    ?>
    <form method="post">
    <p>
        <label for="laji[]">Laji</label><br>
        <?php
        foreach ($laji as $lajit)  {
            extract($lajit);
            echo "<input name=\"laji[]\" type=\"checkbox\" value=\"{$id}\">{$numero} {$nimi}</input><br>";
        }
        ?>
    </p>
    <p>
        <label for="osoite">Osoite: </label>
        <input type="text" name="osoite">
    </p>
    <p>
        <label for="posti">Postinumero: </label>
        <input type="number" name="postinumero">
    </p>
    <p>
        <label for="toimipaikka">Postitoimipaikka: </label>
        <input type="text" name="postitoimipaikka">
    </p>
    <p>
        <label for="syntymä">Syntymä-aika: </label>
        <input type="text" name="syntymaaika">
    </p>
    <p>
        <label>Onko sinulla erikois ruokavalioa? </label><br>
        <label for="ruokavalio">On </label>
        <input type="radio" name="ruokavalio" value="1" id="radio-ruokavalio-1" onclick="showTextForm()">
        <label for="ruokavalio">Ei </label>
        <input type="radio" name="ruokavalio" value="0" id="radio-ruokavalio-2" onclick="hideTextForm()">
        <input type="text" name="erityisruokavalio" value="" id="hideableTextForm">
    </p>
    <p>
        <label>Kuvauslupa </label><br>
        <label for="kuvauslupa">Saa kuvata </label>
        <input type="radio" name="kuvauslupa" value="1">
        <label for="kuvauslupa">Ei saa kuvata </label>
        <input type="radio" name="kuvauslupa" value="0">
    </p>
    <button name="submit" value="ilmoittaudu">Ilmoittaudu</button>
</form>
</div>
<script src="script.js" charset="utf-8"></script>
</body>
</html>
