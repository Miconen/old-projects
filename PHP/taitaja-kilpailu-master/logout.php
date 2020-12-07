<?php
session_start();
$_SESSION['loggedin'] = NULL;
$_SESSION['nimi'] = NULL;
$_SESSION['role'] = NULL;
$_SESSION['id'] = NULL;
session_unset();
session_destroy();
session_regenerate_id();
header("location:index.php", true);
exit();
?>
