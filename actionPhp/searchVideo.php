<?php
$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "biydaalt";
$connect = mysqli_connect($server, $username, $password, $dbname);

if (isset($_POST)) {
    $search = mysqli_real_escape_string($connect, $_POST["video_name"]);
    $query = "
    SELECT * FROM video 
    WHERE video_ner LIKE '%" . $search . "%' LIMIT 7
    ";

    $result = mysqli_query($connect, $query);


    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_array($result)) {
            $ner = $row["video_id"] ;
            switch ($row['video_category_name']) {
                case 'cd':
                    $une = "2000";
                    break;
                case 'dvd':
                    $une = "4000    ";
                    break;
                case 'bd':
                    $une = "3000";
                    break;
            }
            echo "<div  class='content'><div class='info'>";
            echo "<img src=" . $row["img_url"] . ">";
            echo "
                <div class='flex'><span>Нэр:</span><span>" . $row["video_ner"] . "</span></div>
                <div class='flex'><span>Найруулагч:</span><span>" . $row["director"] . "</span></div>
                <div class='flex'><span>Хугацаа:</span><span>" . $row["duration"] . "</span></div>
                <div class='flex'><span>Гарсан он:</span><span>" . $row["release_year"] . "</span></div>
                <div class='flex'><span>Үнэ:</span><span>" . $une . "</span></div></div>
                <a><button onclick='order(`$ner`,`$une`)'>Захиалах</button></a><a target='_blank' href=" . $row["trailer_url"] . "><button>Trailer үзэх</button></a></div>";
        }
    } else {
        echo 'Data Not Found';
    }
}
