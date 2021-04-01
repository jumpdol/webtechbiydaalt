<?php
$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "biydaalt";
$connect = mysqli_connect($server, $username, $password, $dbname);
session_start();
$name = $_SESSION["username"];

$query = "SELECT video_ner, img_url,order_id
FROM video, orderVideo
WHERE video.video_id = orderVideo.video_id AND orderVideo.user_name='$name'";

$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
        echo "<div  class='orderedContent'><div style='
        DISPLAY: FLEX;
        height: 300px;
        ALIGN-ITEMS: CENTER;'>";
        echo "<img style='
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        height: 250px;
        object-fit: contain;' src=" . $row["img_url"] . ">";
        echo "
        <div style='
        display: flex;
        flex-direction: column;
        margin-left: 20px;
        align-items: flex-start;'>
            <div class='flex'><span>Нэр:</span><span>" . $row["video_ner"] . "</span></div>
            <div class='flex'><span>Захиалын дугаар:</span><span>" . $row["order_id"] . "</span></div></div></div>";
    }
} else {
    echo 'Захиалга байхгүй байна';
}
