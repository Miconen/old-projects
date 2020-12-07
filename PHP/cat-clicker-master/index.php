<?php
require ('scripts/utils.php');

session_start();

// Database Connection test... remove comment from line below to test
// require('scripts/dbTest.php');

$login_username = $login_password = $register_username = $register_email = $register_password = NULL;

// Registering start
// Filter post button data

if (filter_input(INPUT_POST, 'register-submit'));

// Checks if post data includes 'register-submit'

if (isset($_POST['register-submit'])) {

	// Inserts new data into database if no matching email nor username in database
	// Inserts code from scripts/dbRegister.php here

	require ('scripts/dbRegister.php');

 // Refer to scripts/dbRegister.php

};

// Registering end
// Login start
// Filter post button data

if (filter_input(INPUT_POST, 'login-submit'));

// Checks if post data includes 'login-submit'

if (isset($_POST['login-submit'])) {

	// Compare login data to database and login if matching data found in database
	// Inserts code from scripts/dbLogin.php here

	require ('scripts/dbLogin.php');

 // Refer to scripts/dbLogin.php

};

// Login end

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- Website favicon start (website icon in browser tab) -->
<link rel="apple-touch-icon" sizes="180x180" href="icon/apple-touch-icon.png">
<link rel="icon" type="icon/png" sizes="32x32" href="icon/favicon-32x32.png">
<link rel="icon" type="icon/png" sizes="16x16" href="icon/favicon-16x16.png">
<link rel="manifest" href="icon/site.webmanifest">
<link rel="mask-icon" href="icon/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<!-- Website favicon end -->
<link rel="stylesheet" type="text/css" href="css/app.css"> <!-- Game css, possibly could be merged with layout.css at some point -->
<link rel="stylesheet" type="text/css" href="css/layout.css"> <!-- Menu css, possibly could be merged with app.css at some point -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- JQuery CND, use local in the future -->
<title>Cat Clicker</title>
</head>
<body>
  <div class="content"></div>
<?php

// Checks if session data contains a 'loggedin' variable
// And if it contains data

if (isset($_SESSION['loggedin'])) {

	// Replace content of the <body> tag with content of bin/loadGame.html by
	// Calling a function from a class called menuLoader wich is located in scripts/utils.php
  $menuLoader->loadGame();
}
else {

	// Replace content of the .content class with content of bin/login-register.html by
	// Calling a function from a class called menuLoader wich is located in scripts/utils.php

	$menuLoader->loadMenu();
};
?>
</body>
</html>
