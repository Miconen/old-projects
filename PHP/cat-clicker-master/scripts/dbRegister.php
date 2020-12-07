<?php
$db = getDbObject();
$sqlimport = 'SELECT username, email FROM user';
$result = $db->query($sqlimport);
$tunnukset = array();
$sahkopostit = array();

while ($row = $result->fetch()) {
	$usernames[] = $row["username"];
	$emails[] = $row["email"];
};
$register_username = filter_input(INPUT_POST, 'register_username', FILTER_SANITIZE_STRING);
$register_password = filter_input(INPUT_POST, 'register_password', FILTER_SANITIZE_STRING);
$register_email = filter_input(INPUT_POST, 'register_email', FILTER_SANITIZE_EMAIL);

if (empty($register_username)) {
	$register_errorMsg[] = "Username Required!";
}

if (empty($register_password)) {
	$register_errorMsg[] = "Password Required!";
};

if (empty($register_email)) {
	$register_errorMsg[] = "Email Required!";
};

if (isset($usernames)) {
	if (in_array($register_username, $usernames)) {
		$register_errorMsg[] = "Username taken!";
	}
}

if (isset($emails)) {
	if (in_array($register_email, $emails)) {
		$register_errorMsg[] = "Email taken!";
	}
}

if (empty($register_errorMsg)) {
	$pwhash = password_hash($register_password, PASSWORD_DEFAULT);
	$sql = 'INSERT INTO user (username, email, password) VALUES (?,?,?)';
	$db = getDbObject();
	$statement = $db->prepare($sql);
	$statement->execute(array($register_username,$register_email,$pwhash));
	$user = $statement->fetch();

	$_SESSION["loggedin"] = $register_username;

	$sql = 'SELECT id FROM user WHERE username=?';
	$db = getDbObject();
	$statement = $db->prepare($sql);
	$statement->execute(array($register_username));
	$user = $statement->fetch();
	$_SESSION["userid"] = $user["id"];
	// Upgrades id's in sql database
	$upgradeArray = array(2, 3, 5, 6, 7, 8, 9, 10 ,11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22);
	$upgradeArraySize = sizeof($upgradeArray);
	$userFor = $user["id"];
	for ($i=0; $upgradeArraySize > $i; $i++) {
		$sql = 'INSERT INTO `user-upgrades` (user_id, upgrade_id, amount) VALUES (?,?,?)';
		$db = getDbObject();
		$statement = $db->prepare($sql);
		$statement->execute(array($userFor, $upgradeArray[$i], 0));
		$user = $statement->fetch();
	};
};
unset($_POST);
?>
