<?php
$login_username = filter_input(INPUT_POST, 'login_username', FILTER_SANITIZE_STRING);
$login_password = filter_input(INPUT_POST, 'login_password', FILTER_SANITIZE_STRING);

if (empty($login_username)) {
	$login_errorMsg[] = "Username Required!";
}

if (empty($login_password)) {
	$login_errorMsg[] = "Username Required!";
}

if (empty($login_errorMsg)) {
	$sql = 'SELECT id, username, password FROM user WHERE username=?';
	$db = getDbObject();
	$statement = $db->prepare($sql);
	$statement->execute(array($login_username));
	$user = $statement->fetch();
}

if (password_verify($login_password, $user["password"])) {
	$_SESSION["loggedin"] = $login_username;
	$_SESSION["userid"] = $user["id"];
}

?>
