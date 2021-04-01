<?php
$uname = $_POST["uname"];
$name = $_POST["name"];

$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "biydaalt";
$connect = mysqli_connect($server, $username, $password, $dbname);


$query = "DELETE FROM doneVideo WHERE user_name='$uname' AND video_name='$name'";
if ($connect->query($query) === TRUE) {
    echo "Амжилттай хүлээн авлаа";
} else {
    echo "Error deleting record: " . $connect->error;
}
