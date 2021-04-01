<?php
session_start();
$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "biydaalt";
$connect = mysqli_connect($server, $username, $password, $dbname);
$id = $_POST["id"];
$une = $_POST["une"];
$username = $_SESSION["username"];

$query = "SELECT user_name FROM orderVideo WHERE user_name='$username' AND video_id=$id ";

$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
        echo "ordered";
    }
} else {
    $sql = "INSERT INTO `orderVideo` (`order_id`, `video_id`,`user_name`,`une`)
    VALUES ( null,'$id','$username','$une')";
    if (mysqli_query($connect, $sql)) {
        echo "suc";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);

        mysqli_close($connect);
    }
}
