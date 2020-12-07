<?php
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('default_charset', 'UTF-8');

function getDbObject() {
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
class menuLoader

{
	public

	function loadGame()
	{
		echo "<script>
        $('body').fadeOut('fast', function(){
          $('body').load('bin/loadGame.php', function(){
            $('body').fadeIn('fast');
          });
        });
      </script>";
	}

	public

	function loadMenu()
	{
		echo "<script>
        $('body').fadeOut('fast', function(){
          $('.content').load('bin/login-register.html', function(){
            $('body').fadeIn('fast');
          });
        });
      </script>";
	}
}

$menuLoader = new menuLoader;

?>
