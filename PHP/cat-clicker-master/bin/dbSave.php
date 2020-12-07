<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/cat-clicker/scripts/utils.php';
$data = $_REQUEST['arr'];
$userid = $_SESSION['userid'];
foreach ($data as $key => $value) {
  foreach ($value as $key2 => $value2) {
    foreach ($value2 as $key3 => $value3) {
        echo $key3 . $value3;
        switch ($key3) {
            case 'currency':
                $sql = 'UPDATE user SET currency = ? WHERE id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid));
                $user = $statement->fetch();
                break;
            case 'active-0':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 13));
                $user = $statement->fetch();
                break;
            case 'active-1':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 14));
                $user = $statement->fetch();
                break;
            case 'active-2':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 15));
                $user = $statement->fetch();
                break;
            case 'active-3':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 16));
                $user = $statement->fetch();
                break;
            case 'active-4':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 17));
                $user = $statement->fetch();
                break;
            case 'active-5':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 18));
                $user = $statement->fetch();
                break;
            case 'active-6':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 19));
                $user = $statement->fetch();
                break;
            case 'active-7':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 20));
                $user = $statement->fetch();
                break;
            case 'active-8':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 21));
                $user = $statement->fetch();
                break;
            case 'active-9':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 22));
                $user = $statement->fetch();
                break;
            case 'passive-0':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 2));
                $user = $statement->fetch();
                break;
            case 'passive-1':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 3));
                $user = $statement->fetch();
                break;
            case 'passive-2':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 5));
                $user = $statement->fetch();
                break;
            case 'passive-3':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 6));
                $user = $statement->fetch();
                break;
            case 'passive-4':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 7));
                $user = $statement->fetch();
                break;
            case 'passive-5':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 8));
                $user = $statement->fetch();
                break;
            case 'passive-6':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 9));
                $user = $statement->fetch();
                break;
            case 'passive-7':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 10));
                $user = $statement->fetch();
                break;
            case 'passive-8':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 11));
                $user = $statement->fetch();
                break;
            case 'passive-9':
                $sql = 'UPDATE `user-upgrades` SET amount = ? WHERE user_id = ? AND upgrade_id = ?;';
                $db = getDbObject();
                $statement = $db->prepare($sql);
                $statement->execute(array($value3, $userid, 12));
                $user = $statement->fetch();
                break;
            default:
                return;
                break;
        }
    }
  }
}
?>
