<?php
$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "biydaalt";
$connect = mysqli_connect($server, $username, $password, $dbname);
$usname = $_POST["username"];

$sql = "SELECT  user_name, user_pass,user_admin FROM user WHERE user_name = '$usname'";

if ($result = mysqli_query($connect, $sql)) {

    if (mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        if ($row['user_name'] == $usname) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $row['user_name'];
            if ($row['user_admin'] == 1) {
                $_SESSION["admin"] = true;
                echo true;
            } else {
                $_SESSION["admin"] = false;
                echo false;
            }
        }
    } else {
        echo "хэрэглэгчийн нэр эсвэл нууц үг буруу байна";
    }


    mysqli_close($connect);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
}
