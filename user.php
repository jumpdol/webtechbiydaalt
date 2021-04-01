<?php
$data = array();
session_start();
$_SESSION["videoUrl"] = "";
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    if ($_SESSION["admin"] == 1) {
        header("location: http://localhost/demo1/dist/index.php");
    }
} else {

    header("location: http://localhost/demo1/dist/custom/pages/login/classic/login.php");
}
$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "biydaalt";
$connect = mysqli_connect($server, $username, $password, $dbname);


$sql = "SELECT * FROM video LIMIT 7";

if ($result = mysqli_query($connect, $sql)) {

    if (mysqli_num_rows($result) > 0) {

        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
    } else {
        echo "хэрэглэгчийн нэр эсвэл нууц үг буруу байна";
    }


    mysqli_close($connect);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
}
?>

<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <title>Бие даалт</title>
    <style>
        .orderedContent {
            width: 100%;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        body {
            margin: 0;
            background-color: #ccc;
        }

        .search input {
            padding: 10px;
            width: 80%;
            border-radius: 15px;
            border: none;
        }

        .search {
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .contents {
            flex-wrap: wrap;
            display: flex;
            padding: 20px;
            padding-right: 0;

        }

        .content {
            margin-right: 34px;
            font-family: sans-serif;
            font-weight: bold;
            border-radius: 5px;
            background-color: white;
            justify-content: space-between;
            align-items: center;
            display: flex;
            flex-direction: column;
            width: 290px;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .content img {
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            height: 250px;
            width: 100%;
            object-fit: contain;

        }

        .content span {
            margin-top: 10px;
            margin-left: 10px;
        }

        .info {
            display: flex;
            flex-direction: column;
        }

        button {

            width: 100%;
            background-color: #00b016;
            text-transform: uppercase;
            color: #fff;
            font-weight: bold;
            padding: 10px;
            border-radius: 35px;
            border: none;
            margin-top: 10px;
            cursor: pointer;
        }

        .bests {
            padding: 0px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .best {
            width: 49%;
            background-color: white;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 380px;
        }

        .best .img {
            width: 50%;
        }

        .img img {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
            width: 100%;
        }

        .best .info {
            width: 40%;
            padding-right: 5%;
            display: flex;
            font-weight: bold;
            font-size: 20px;
            font-family: sans-serif;
        }

        .best .info span {
            font-size: 60px;
            margin-bottom: 20px
        }

        .flex {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="search">
        <input onkeyup="search(this.value)" placeholder="Search...">
        <button id="openmodal" style="font-size: 40px; margin-right:40px; cursor:pointer ;width:60px  "><i class="fa fa-list" aria-hidden="true"></i>
        </button>
        <button onclick="logout()" style="font-size: 40px; margin-right:40px; cursor:pointer ;width:60px  ">
            <i class="fa fa-user"></i>
        </button>
    </div>
    <div id="contents" class="contents"></div>
    <div class="bests">
        <div class="week best" id="week"></div>
        <div class="month best" id="month">
            
        </div>
    </div>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="orders" style="
    max-height: 600px;
    overflow-y: scroll;
    overflow-x: hidden;"></div>
        </div>

    </div>

</body>

</html>
<script>
    function order(a, une) {
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (xml.readyState == 4 && xml.status == 200) {
                if (xml.response == "ordered") {
                    alert("Захиалсан кино байна")
                } else if (xml.response == "suc") {
                    alert("Амжилттай захиалагдлаа")
                } else {
                    alert(xml.response)
                }
            }
        }
        xml.open("POST", "actionPhp/orderVideo.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send("&id=" + a + "&une=" +
            une);
    }
    // Get the modal
    var modal = document.getElementById("myModal");
    var openM = document.getElementById("openmodal")

    openM.onclick = function() {

        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (xml.readyState == 4 && xml.status == 200) {
                document.getElementById("orders").innerHTML = xml.response
            }
        }
        xml.open("POST", "actionPhp/myOrders.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send();
        modal.style.display = 'block';
    }

    load_data("");
    getWeekBest()
    getMonthBest()
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
    function getWeekBest(){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (xml.readyState == 4 && xml.status == 200) {
                console.log(xml.response+"aldaa")
                document.getElementById("week").innerHTML = xml.response;
            }
        }
        xml.open("POST", "actionPhp/watch.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send("");
    }
    function getMonthBest(){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (xml.readyState == 4 && xml.status == 200) {
                console.log(xml.response)
                document.getElementById("month").innerHTML = xml.response;
            }
        }
        xml.open("POST", "actionPhp/connection.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send("");
    }


    function search(str) {
        var search = str;
        if (search != '') {
            load_data(search);
        } else {
            load_data("");
        }
    };

    function load_data(query) {
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (xml.readyState == 4 && xml.status == 200) {
                document.getElementById("contents").innerHTML = xml.response;
            }
        }
        xml.open("POST", "actionPhp/searchVideo.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send("&video_name=" + query);
    }

    function logout() {

        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (xml.readyState == 4 && xml.status == 200) {
                window.location = "http://localhost/demo1/dist/custom/pages/login/classic/login.php";

            }
        }
        xml.open("POST", "http://localhost/demo1/dist/logout.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send();
    };
</script>