<?php

// Declare database connection from utils.php
// "I'm supposed to be called after utils.php on whatever site i'm called on"

$db = getDbObject(); // Refer to scripts/utils.php for function (getDbObject)

// Database call
// Selects username of user with id: 21 from table: user

$sql = "SELECT username FROM user WHERE id=21";
$result = $db->query($sql);
$textVar = array();

while ($row = $result->fetch()) {
	$textVar[] = $row;
};

// Extracts array with results

foreach($textVar as $yupyup) {
	extract($yupyup);
};

// If the succesfull content couldn't be loaded...

if ($username == "mico") {
	echo "Database connection succesfull!";
}

// ...show error

else {
	echo "Database connection failed :(";
}

?>
