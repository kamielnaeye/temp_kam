<?php
$arr = array();
$mysqli = new mysqli('localhost', 'pi', 'raspberry', 'temperature');
if ($mysqli->connect_error) {
die('Connect Error (' . $mysqli->connect_errno . ') '
. $mysqli->connect_error);
}
$result = $mysqli->query("SELECT * FROM temperature");
while ($row = $result->fetch_assoc()) {
    array_push($arr, $row["TEMP"]);
}
echo json_encode($arr);
$mysqli -> close();
?>

