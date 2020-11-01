<?

$db = "Salesdock";
$server = "127.0.0.1";
$user = "root";
$pass = "root";

$Database = odbc_connect("Driver={SQL Server};Server=".$server.";Database=".$db.";Charset=UTF-8", $user, $pass) or die("Error Connecting to Database");

?>