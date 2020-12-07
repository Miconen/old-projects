<?php
function loadButtons() {
  $rdbms = 'mysql';
  $host = 'localhost';
  $db = 'cat-clicker';
  $user = 'root';
  $pass = '';
  $charset = 'utf8';
  $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false, ];
  $connectionString = "$rdbms:host=$host;dbname=$db;charset=$charset";
  return new PDO($connectionString, $user, $pass, $opt);
};
$db = loadButtons();
$sql = 'SELECT * FROM upgrades';
$result = $db->query($sql);
$upgrades = array();
while ($row = $result->fetch()) {
extract($row);
$upgrades[] = $row;
};
?>
