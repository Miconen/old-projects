<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=utf-8');
require('utility.php');
$db = getDbObject();
session_start();

if (isset($_SESSION['loggedin'])) {
    header("Location: "."ilmoittautumiset.php");
    exit();
};

$tunnus = $etunimi = $sukunimi = $salasana = $email = $puhelin = $user = NULL;
$rooli = "user";
if(filter_input(INPUT_POST, 'submit'));
if(isset($_POST['submit'])){

    $sqlimport = 'SELECT tunnus, email FROM kayttaja';
    $result = $db->query($sqlimport);
    $tunnukset = array();
    $sahkopostit = array();
    while ($row = $result->fetch()) {
        $tunnukset[] = $row["tunnus"];
        $sahkopostit[] = $row["email"];
    };
    $tunnus = filter_input(INPUT_POST, 'tunnus', FILTER_SANITIZE_STRING);
    $etunimi = filter_input(INPUT_POST, 'etunimi', FILTER_SANITIZE_STRING);
    $sukunimi = filter_input(INPUT_POST, 'sukunimi', FILTER_SANITIZE_STRING);
    $salasana = filter_input(INPUT_POST, 'salasana', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $puhelin = filter_input(INPUT_POST, 'puhelin', FILTER_SANITIZE_NUMBER_INT);
    if (empty($tunnus) || empty($etunimi) || empty($sukunimi) || empty($salasana) || empty($email) || empty($puhelin)) {
        $errorMsg = "Täytä kaikki kentät";
    }
    elseif (in_array($tunnus,$tunnukset) && in_array($email,$sahkopostit)) {
        $errorMsg = "Sähköposti ja tunnus on jo käytössä";
    }
    elseif (in_array($tunnus,$tunnukset)) {
        $errorMsg = "Tunnus on jo käytössä";
    }
    elseif (in_array($email,$sahkopostit)) {
        $errorMsg = "Sähköposti on jo käytössä";
    }
    else {
        $pwhash = password_hash($salasana, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO kayttaja (tunnus,etunimi,sukunimi,salasana,email,puhelin,rooli) VALUES (?,?,?,?,?,?,?)';
        $db = getDbObject();
        $statement = $db->prepare($sql);
        $statement->execute(array($tunnus,$etunimi,$sukunimi,$pwhash,$email,$puhelin,$rooli));
        $user = $statement->fetch();
        session_start();
        $_SESSION["loggedin"] = $user["tunnus"];
        header("Location: "."ilmoittautumiset.php");
    };
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
        echo '<li class="currentPageLi"><a class="currentPage" href="register.php">Rekisteröidy</a></li>';
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
<h1>Rekisteröityminen</h1>
<?php
if(isset ($errorMsg)) {
    echo "<p>$errorMsg</p>";
};
?>
<form method="post">
    <p>
    <label for="tunnus">Käyttäjätunnus</label>
    <input type="text" name="tunnus">
    </p>
    <p>
    <label for="etunimi">Etunimi</label>
    <input type="text" name="etunimi">
    </p>
    <p>
    <label for="sukunimi">Sukunimi</label>
    <input type="text" name="sukunimi">
    </p>
    <p>
    <label for="salasana">Salasana</label>
    <input type="password" name="salasana">
    </p>
    <p>
    <label for="email">Email</label>
    <input type="email" name="email">
    </p>
    <p>
    <label for="puhelin">Puhelin nro.</label>
    <input type="text" name="puhelin">
    </p>
    <button name="submit" value="register">Rekisteröidy</button>
</form>
</div>
</body>
</html>
