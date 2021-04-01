<?php


$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "biydaalt";
$connect = mysqli_connect($server, $username, $password, $dbname);
$name = $_POST["name"];
$director = $_POST["director"];
$duration = $_POST["duration"];
$release = $_POST["release"];
$url = $_POST["url"];
$imgurl = $_POST["imgurl"];
$category = $_POST["category"];


$sql = "INSERT INTO video (video_id, video_ner,director,duration,release_year,trailer_url,img_url,video_category_name)
 VALUES (null,'$name','$director','$duration','$release','$url','$imgurl','$category')";

if (mysqli_query($connect, $sql)) {
    echo "suc";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);

    mysqli_close($connect);
}
