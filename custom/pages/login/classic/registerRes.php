<?php
$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "biydaalt";
$connect = mysqli_connect($server, $username, $password, $dbname);
$output = '';
$user_id = null;
$full_name = $_POST["fullname"];
$username = $_POST["username"];
$password = $_POST["pass"];
$passwordrepeat = $_POST["passr"];
$phone = $_POST["phone"];
$sql = "INSERT INTO `user` (`user_name`, `user_fname`,`user_pass`,`user_pass_repeat`,`user_phone`)
VALUES ( '$username','$full_name','$password','$passwordrepeat','$phone')";
if (mysqli_query($connect, $sql)) {
    echo "suc";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);

    mysqli_close($connect);
}
