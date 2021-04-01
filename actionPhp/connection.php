<?php
$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "biydaalt";
$connect = mysqli_connect($server, $username, $password, $dbname);


$query = "select distinct video_ner as bestSellerByMonth from orderhistory
 where video_ner like 
 (select video_ner as bestSeller from orderhistory
 where month(ts) like '11'
 group by video_ner
 order by count(bestSeller) desc
 limit 1);";
// $query = "SELECT * FROM `orderhistory` LIMIT 1";
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="img">
        <img src="https://mves.mcssga.org/wp-content/uploads/2020/03/best-books-of-the-month-1.png">
    </div>
    <div class="info">
        <div style="
height: 98px;
text-align: center;
">Өнгөрсөн сарын шилдэг</div>
        <span style="text-align: center;">'.$row[0].'</span></a>
    </div>';
    }
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connect);

    mysqli_close($connect);
}
