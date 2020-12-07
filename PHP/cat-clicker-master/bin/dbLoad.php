<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/cat-clicker/scripts/utils.php';
$userid = $_SESSION['userid'];

if (isset($_REQUEST['currency'])) {
    $sql = 'SELECT currency FROM user WHERE id=?';
	$db = getDbObject();
	$statement = $db->prepare($sql);
	$statement->execute(array($userid));
	$user = $statement->fetch();
    echo $user['currency'];
}

if (isset($_REQUEST['type'])) {
    $upgrade_id = $_REQUEST['i'];
    $sql = 'SELECT amount FROM `user-upgrades` WHERE user_id=? AND upgrade_id=?';
    $db = getDbObject();
    $statement = $db->prepare($sql);
    $statement->execute(array($userid, $upgrade_id));
    $user = $statement->fetch();
    echo $user['amount'];
}
?>
