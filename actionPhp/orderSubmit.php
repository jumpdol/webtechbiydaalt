<?php
$id = $_POST["id"];
$videoName = $_POST["video"];
$usname = $_POST["username"];
$une = $_POST["une"];

$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "biydaalt";
$connect = mysqli_connect($server, $username, $password, $dbname);

$sql = "INSERT INTO `doneVideo` (`video_name`,`user_name`,`ts`)
VALUES ( '$videoName','$usname',null)";

if (mysqli_query($connect, $sql)) {
    $query = "DELETE FROM orderVideo WHERE order_id='$id'";
    if ($connect->query($query) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connect->error;
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);

    mysqli_close($connect);
}

$query1 = "INSERT INTO orderHistory (`history_id`,`video_ner`,`ts`,`une`) VALUES (null,'$videoName',null,'$une')";
if (mysqli_query($connect, $query1)) {
    echo "suc";
} else {
    echo "Error: " . $query1 . "<br>" . mysqli_error($connect);

    mysqli_close($connect);
}
