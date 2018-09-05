<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "gresgi_mag";
//$url = "http://sugargliderinfo.org/store/pdfdom/";
$url = "http://localhost/misc/pdfdom/";
$fileName = "D:/wamp/www/misc/pdfdom/test.pdf";

mysql_connect($hostname,$username,$password) or die("Database not found");
mysql_select_db($dbname) or die("Database not connected");

$exportFileUrl = $url."export_cage.php";
$exportUrl = $url."index.php";
$path = $url;
$relpath = $url."test.pdf";
?>