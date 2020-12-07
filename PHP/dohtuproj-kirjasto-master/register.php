<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=utf-8');
require('utility.php');
$db = getDbObject();
session_start();

if (isset($_SESSION['loggedin'])) {
    header("Location: "."index.php");
    exit();
};

$tunnus = $salasana = $email = $user = NULL;
$rooli = "user";
if(filter_input(INPUT_POST, 'submit'));
if(isset($_POST['submit'])){

    $sqlimport = 'SELECT tunnus, email FROM dohtuproj_kirjasto_kayttaja';
    $result = $db->query($sqlimport);
    $tunnukset = array();
    $sahkopostit = array();
    while ($row = $result->fetch()) {
        $tunnukset[] = $row["tunnus"];
        $sahkopostit[] = $row["email"];
    };
    $tunnus = filter_input(INPUT_POST, 'tunnus', FILTER_SANITIZE_STRING);
    $salasana = filter_input(INPUT_POST, 'salasana', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (empty($tunnus) || empty($salasana) || empty($email)) {
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
        $sql = 'INSERT INTO dohtuproj_kirjasto_kayttaja (tunnus,salasana,rooli,email) VALUES (?,?,?,?)';
        $db = getDbObject();
        $statement = $db->prepare($sql);
        $statement->execute(array($tunnus,$pwhash,$rooli,$email));
        $user = $statement->fetch();
		if(!isset($_SESSION))
		{
			session_start();
		}
        $_SESSION["loggedin"] = $user["tunnus"];
        $_SESSION["role"] = $user["rooli"];
        header("Location: "."index.php");
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
        echo '<li><a href="kirjat.php">Kirjat</a></li>';
        };
        if(!isset($_SESSION['loggedin'])) {
        echo '<li><a href="login.php">Login</a></li>';
        };
        if(!isset($_SESSION['loggedin'])) {
        echo '<li class="currentPageLi"><a class="currentPage" href="register.php">Register</a></li>';
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
    <label for="salasana">Salasana</label>
    <input type="password" name="salasana">
    </p>
    <p>
    <label for="email">Email</label>
    <input type="email" name="email">
    </p>
    <button name="submit" value="register">Rekisteröidy</button>
	<p>Joudut kirjautumaan rekisteröinnin jälkeen.</p>
</form>
</div>
</body>
</html>
