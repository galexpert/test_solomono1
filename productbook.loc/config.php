<?php defined("PRODUCTBOOK") or die("Access denied");

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DB", "productbookdb");
define("PATH", "http://productbook.loc/");



//$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die("Нет соединения с БД");
$connection = new mysqli(DBHOST, DBUSER, DBPASS, DB);
mysqli_set_charset($connection, "utf8") or die("Не установлена кодировка соединения");