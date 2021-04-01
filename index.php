<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    if ($_SESSION["admin"] == 0) {
        header("location: http://localhost/demo1/dist/user.php");
    }
} else {

    header("location: http://localhost/demo1/dist/custom/pages/login/classic/login.php");
}

$server = "localhost:3306";
$username = "root";
$password = "";
$dbname = "biydaalt";
$connect = mysqli_connect($server, $username, $password, $dbname);
$query = "SELECT order_id,video_ner,user_name,une FROM orderVideo,video WHERE orderVideo.video_id=video.video_id";
$arr = array();
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
        array_push($arr, $row);
    }
} else {
}
$sql = "SELECT * FROM doneVideo";
$array = array();
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) > 0) {

    while ($roww = mysqli_fetch_array($res)) {
        array_push($array, $roww);
    }
} else {
}
$sql1 = "SELECT * FROM orderHistory";
$array1 = array();
$res1 = mysqli_query($connect, $sql1);
if (mysqli_num_rows($res1) > 0) {

    while ($row1 = mysqli_fetch_array($res1)) {
        array_push($array1, $row1);
    }
} else {
}
?>


<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Metronic | Dashboard</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="assets/css/themes/layout/header/base/light.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/header/menu/light.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/brand/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <link href="assets/css/themes/layout/aside/dark.css?v=7.0.5" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <style>
        .orderLine {

            DISPLAY: flex;
            JUSTIFY-CONTENT: space-between;
            padding: 10px 20px;
            border-bottom: 1px solid;
            align-items: center;
        }

        .orderId {
            width: 20%;
            word-wrap: break-word;
            text-align: center;
        }

        .button {
            cursor: pointer;
            padding: 10px 10px;
            background-color: red;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->
<script>
    function doneOrder(name, uname) {
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (xml.readyState == 4 && xml.status == 200) {
                console.log(xml.response)
                var n = xml.response.search("Амжилттай")
                if (n > -1) {
                    alert("Амжилттай хүлээж авлаа");
                    location.reload();
                }
            }
        }
        xml.open("POST", "http://localhost/demo1/dist/actionPhp/doneOrder.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send("name=" + name + "&uname=" + uname);


    }


    function orderSubmit(id, videoName, usname, une) {
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (xml.readyState == 4 && xml.status == 200) {
                console.log(xml.response)
                var n = xml.response.search("successfully")
                if (n > -1) {
                    alert("Амжилттай баталгаажлаа та одоо хэрэглэчид видеог өгж болно");
                    location.reload();
                }
            }
        }
        xml.open("POST", "http://localhost/demo1/dist/actionPhp/orderSubmit.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send("id=" + id + "&video=" + videoName + "&username=" + usname + "&une=" + une);
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
    }
</script>


<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Aside-->
            <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
                <!--begin::Brand-->
                <div class="brand flex-column-auto" id="kt_brand">
                    <!--begin::Logo-->
                    <a href="index.html" class="brand-logo">
                        <img alt="Logo" src="assets/media/logos/logo-light.png" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Toggle-->
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                                    <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </button>
                    <!--end::Toolbar-->
                </div>
                <!--end::Brand-->
                <!--begin::Aside Menu-->
                <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                    <!--begin::Menu Container-->
                    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
                        <!--begin::Menu Nav-->
                        <ul class="menu-nav">
                            <li class="menu-item menu-item-active" aria-haspopup="true">
                                <a href="#" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="menu-section">
                                <h4 class="menu-text">Custom</h4>
                                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="svg-icon menu-icon">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-text">Applications</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                                            <span class="menu-link">
                                                <span class="menu-text">Applications</span>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="svg-icon menu-icon">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Barcode-read.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" />
                                                <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-text">Pages</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                                            <span class="menu-link">
                                                <span class="menu-text">Pages</span>
                                            </span>
                                        </li>
                                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Login</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu">
                                                <i class="menu-arrow"></i>
                                                <ul class="menu-subnav">
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/login/login-1.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Login 1</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/login/login-2.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Login 2</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                                        <a href="javascript:;" class="menu-link menu-toggle">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Login 3</span>
                                                            <span class="menu-label">
                                                                <span class="label label-inline label-info">Wizard</span>
                                                            </span>
                                                            <i class="menu-arrow"></i>
                                                        </a>
                                                        <div class="menu-submenu">
                                                            <i class="menu-arrow"></i>
                                                            <ul class="menu-subnav">
                                                                <li class="menu-item" aria-haspopup="true">
                                                                    <a href="custom/pages/login/login-3/signup.html" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text">Sign Up</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item" aria-haspopup="true">
                                                                    <a href="custom/pages/login/login-3/signin.html" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text">Sign In</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item" aria-haspopup="true">
                                                                    <a href="custom/pages/login/login-3/forgot.html" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text">Forgot Password</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                                        <a href="javascript:;" class="menu-link menu-toggle">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Login 4</span>
                                                            <span class="menu-label">
                                                                <span class="label label-inline label-info">Wizard</span>
                                                            </span>
                                                            <i class="menu-arrow"></i>
                                                        </a>
                                                        <div class="menu-submenu">
                                                            <i class="menu-arrow"></i>
                                                            <ul class="menu-subnav">
                                                                <li class="menu-item" aria-haspopup="true">
                                                                    <a href="custom/pages/login/login-4/signup.html" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text">Sign Up</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item" aria-haspopup="true">
                                                                    <a href="custom/pages/login/login-4/signin.html" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text">Sign In</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item" aria-haspopup="true">
                                                                    <a href="custom/pages/login/login-4/forgot.html" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text">Forgot Password</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                                        <a href="javascript:;" class="menu-link menu-toggle">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Classic</span>
                                                            <i class="menu-arrow"></i>
                                                        </a>
                                                        <div class="menu-submenu">
                                                            <i class="menu-arrow"></i>
                                                            <ul class="menu-subnav">
                                                                <li class="menu-item" aria-haspopup="true">
                                                                    <a href="custom/pages/login/classic/login-1.html" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text">Login 1</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item" aria-haspopup="true">
                                                                    <a href="custom/pages/login/classic/login-2.html" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text">Login 2</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item" aria-haspopup="true">
                                                                    <a href="custom/pages/login/classic/login-3.html" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text">Login 3</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item" aria-haspopup="true">
                                                                    <a href="custom/pages/login/classic/login-4.html" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text">Login 4</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item" aria-haspopup="true">
                                                                    <a href="custom/pages/login/classic/login-5.html" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text">Login 5</span>
                                                                    </a>
                                                                </li>
                                                                <li class="menu-item" aria-haspopup="true">
                                                                    <a href="custom/pages/login/classic/login-6.html" class="menu-link">
                                                                        <i class="menu-bullet menu-bullet-dot">
                                                                            <span></span>
                                                                        </i>
                                                                        <span class="menu-text">Login 6</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Wizard</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu">
                                                <i class="menu-arrow"></i>
                                                <ul class="menu-subnav">
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/wizard/wizard-1.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Wizard 1</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/wizard/wizard-2.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Wizard 2</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/wizard/wizard-3.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Wizard 3</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/wizard/wizard-4.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Wizard 4</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Pricing Tables</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu">
                                                <i class="menu-arrow"></i>
                                                <ul class="menu-subnav">
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/pricing/pricing-1.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Pricing Tables 1</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/pricing/pricing-2.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Pricing Tables 2</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/pricing/pricing-3.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Pricing Tables 3</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/pricing/pricing-4.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Pricing Tables 4</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Invoices</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu">
                                                <i class="menu-arrow"></i>
                                                <ul class="menu-subnav">
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/invoices/invoice-1.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Invoice 1</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/invoices/invoice-2.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Invoice 2</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                            <a href="javascript:;" class="menu-link menu-toggle">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Error</span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            <div class="menu-submenu">
                                                <i class="menu-arrow"></i>
                                                <ul class="menu-subnav">
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/error/error-1.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Error 1</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/error/error-2.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Error 2</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/error/error-3.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Error 3</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/error/error-4.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Error 4</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/error/error-5.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Error 5</span>
                                                        </a>
                                                    </li>
                                                    <li class="menu-item" aria-haspopup="true">
                                                        <a href="custom/pages/error/error-6.html" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Error 6</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-section">
                                <h4 class="menu-text">Layout</h4>
                                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                            </li>
                            <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <span class="svg-icon menu-icon">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Bucket.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z" fill="#000000" fill-rule="nonzero" transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
                                                <path d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-text">Themes</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                                            <span class="menu-link">
                                                <span class="menu-text">Themes</span>
                                            </span>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="layout/themes/aside-light.html" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Light Aside</span>
                                            </a>
                                        </li>
                                        <li class="menu-item" aria-haspopup="true">
                                            <a href="layout/themes/header-dark.html" class="menu-link">
                                                <i class="menu-bullet menu-bullet-dot">
                                                    <span></span>
                                                </i>
                                                <span class="menu-text">Dark Header</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <!--end::Menu Nav-->
                    </div>
                    <!--end::Menu Container-->
                </div>
                <!--end::Aside Menu-->
            </div>
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header header-fixed">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <!--begin::Header Menu Wrapper-->
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                            <!--begin::Header Menu-->
                            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                                <!--begin::Header Nav-->
                                <ul class="menu-nav">



                                </ul>
                                <!--end::Header Nav-->
                            </div>
                            <!--end::Header Menu-->
                        </div>
                        <!--end::Header Menu Wrapper-->
                        <!--begin::Topbar-->
                        <div class="topbar">
                            <!--begin::Search-->
                            <div class="dropdown" id="kt_quick_search_toggle">
                                <!--begin::Toggle-->
                                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                    <div class="btn btn-icon btn-clean btn-lg btn-dropdown mr-1">
                                        <span class="svg-icon svg-icon-xl svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                </div>
                                <!--end::Toggle-->
                                <!--begin::Dropdown-->
                                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                                    <div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
                                        <!--begin:Form-->
                                        <form method="get" class="quick-search-form">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <span class="svg-icon svg-icon-lg">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Search..." />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="quick-search-close ki ki-close icon-sm text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                        <!--end::Form-->
                                        <!--begin::Scroll-->
                                        <div class="quick-search-wrapper scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
                                        <!--end::Scroll-->
                                    </div>
                                </div>
                                <!--end::Dropdown-->
                            </div>
                            <!--end::Search-->



                            <!--begin::User-->
                            <div class="topbar-item">
                                <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?php echo $_SESSION["username"] ?></span>
                                    <span class="symbol symbol-35 symbol-light-success">
                                        <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                                    </span>
                                </div>
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center flex-wrap mr-2">
                                <!--begin::Page Title-->
                                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                                <!--end::Page Title-->
                                <!--begin::Actions-->
                                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                                <span class="text-muted font-weight-bold mr-4">#XRS-45670</span>
                                <a href="addNew.php" class="btn btn-light-warning font-weight-bolder btn-sm">Add New</a>
                                <!--end::Actions-->
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                    <!--end::Subheader-->
                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Dashboard-->
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-lg-6 col-xxl-4">
                                    <!--begin::Mixed Widget 1-->
                                    <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                                        <!--begin::Header-->
                                        <div class="card-header border-0 bg-danger py-5">
                                            <h3 class="card-title font-weight-bolder text-white">Sales Stat</h3>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body p-0 position-relative overflow-hidden">
                                            <!--begin::Chart-->
                                            <div id="kt_mixed_widget_1_chart" class="card-rounded-bottom bg-danger" style="height: 200px"></div>
                                            <!--end::Chart-->
                                            <!--begin::Stats-->
                                            <div class="card-spacer mt-n25">
                                                <!--begin::Row-->
                                                <div class="row m-0">
                                                    <div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
                                                        <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
                                                                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
                                                                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
                                                                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <a href="#" class="text-warning font-weight-bold font-size-h6">Weekly Sales</a>
                                                    </div>
                                                </div>
                                                <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7">
                                                    <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    <a href="addEmployee.php" class="text-danger font-weight-bold font-size-h6 mt-2">Ажилтан нэмэх</a>
                                                </div>
                                                <!--end::Row-->
                                                <!--begin::Row-->

                                                <!--end::Row-->
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Mixed Widget 1-->
                                </div>
                                <div class="col-lg-6 col-xxl-4">
                                    <!--begin::List Widget 9-->
                                    <div class="card card-custom card-stretch gutter-b">
                                        <!--begin::Header-->
                                        <div class="card-header align-items-center border-0 mt-4">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="font-weight-bolder text-dark">Захиалгууд</span>
                                                <span class="text-muted mt-3 font-weight-bold font-size-sm"><?php echo count($arr) ?> Захиалга</span>
                                            </h3>
                                        </div>
                                        <div style="
                                                    max-height: 430px;
                                                    overflow-x: hidden;
                                                    overflow-y: scroll;">

                                            <div class='orderLine'>
                                                <div class='orderId'>Захиалгын дугаар</div>
                                                <div class='orderId'>Видеоны нэр</div>
                                                <div class='orderId'>Хэрэглэгчийн нэр</div>
                                                <div class='orderId'>Үнэ</div>
                                                <div class='orderId'>Товч</div>
                                            </div>
                                            <?php
                                            if (count($arr) == 0) {

                                                echo 'Одоогоор хэрэглэгчид видео захиалаагүй байна';
                                            } else {
                                                for ($i = 0; $i < count($arr); $i++) {
                                                    $video_name = $arr[$i]['video_ner'];
                                                    $order_id = $arr[$i]['order_id'];
                                                    $order_user = $arr[$i]['user_name'];
                                                    $une = $arr[$i]['une'];
                                                    echo "
                                                    <div class='orderLine'>
                                                        <div class='orderId'>" . $arr[$i]['order_id'] . "</div>
                                                        <div class='orderId'>" . $arr[$i]['video_ner'] . "</div>
                                                        <div class='orderId'>" . $arr[$i]['user_name'] . "</div>
                                                        <div class='orderId'>" . $arr[$i]['une'] . "</div>
                                                        <div class='button orderId' onclick='orderSubmit(`$order_id`,`$video_name`,`$order_user`,`$une`)'>Батлах</div>
                                                    </div>";
                                                }
                                            }
                                            ?>
                                        </div>
                                        <!--end::Header-->
                                    </div>
                                    <!--end: Card-->
                                    <!--end: List Widget 9-->
                                </div>
                                <div class="col-lg-6 col-xxl-4">
                                    <!--begin::List Widget 9-->
                                    <div class="card card-custom card-stretch gutter-b">
                                        <!--begin::Header-->
                                        <div class="card-header align-items-center border-0 mt-4">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="font-weight-bolder text-dark">Захиалгаа авсан хэрэглэгчид</span>
                                                <span class="text-muted mt-3 font-weight-bold font-size-sm"><?php echo count($array) ?> Хүлээгдэж байгаа</span>
                                            </h3>
                                        </div>
                                        <div style="
                                                    max-height: 430px;
                                                    overflow-x: hidden;
                                                    overflow-y: scroll;">

                                            <div class='orderLine'>
                                                <div class='orderId'>Видеоны нэр</div>
                                                <div class='orderId'>Хэрэглэгчийн нэр</div>
                                                <div class='orderId'>Авсан огноо</div>
                                                <div class='orderId'>Товч</div>
                                            </div>
                                            <?php
                                            if (count($array) == 0) {
                                                echo 'Одоогоор хэрэглэгчид видео өгөгдөөгүй байна';
                                            } else {
                                                for ($i = 0; $i < count($array); $i++) {
                                                    $name = $array[$i]['video_name'];
                                                    $uname = $array[$i]['user_name'];
                                                    echo "
                                                    <div class='orderLine'>
                                                        <div class='orderId'>" . $array[$i]['video_name'] . "</div>
                                                        <div class='orderId'>" . $array[$i]['user_name'] . "</div>
                                                        <div class='orderId'>" . $array[$i]['ts'] . "</div>
                                                        <div class='button orderId' onclick='doneOrder(`$name`,`$uname`)'>Хүлээж авах</div>
                                                    </div>";
                                                }
                                            }
                                            ?>
                                        </div>
                                        <!--end::Header-->
                                    </div>
                                    <!--end: Card-->
                                    <!--end: List Widget 9-->
                                </div>
                                <div class="col-lg-6 col-xxl-4">
                                    <!--begin::List Widget 9-->
                                    <div class="card card-custom card-stretch gutter-b">
                                        <!--begin::Header-->
                                        <div class="card-header align-items-center border-0 mt-4">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="font-weight-bolder text-dark">Захиалгын түүх</span>
                                                <span class="text-muted mt-3 font-weight-bold font-size-sm"><?php echo count($array) ?> Хүлээгдэж байгаа</span>
                                            </h3>
                                        </div>
                                        <div style="
                                                    max-height: 430px;
                                                    overflow-x: hidden;
                                                    overflow-y: scroll;">

                                            <div class='orderLine'>
                                                <div class='orderId'>Видеоны нэр</div>
                                                <div class='orderId'>Хэрэглэгчийн нэр</div>
                                                <div class='orderId'>Авсан огноо</div>
                                                <div class='orderId'>Товч</div>
                                            </div>
                                            <?php
                                            if (count($array1) == 0) {
                                                echo 'Одоогоор хэрэглэгчид видео өгөгдөөгүй байна';
                                            } else {
                                                foreach ($array1 as &$value) {

                                                    echo "
                                                    <div class='orderLine'>
                                                        <div class='orderId'>" . $value['history_id'] . "</div>
                                                        <div class='orderId'>" .  $value['video_ner'] . "</div>
                                                        <div class='orderId'>" . $value['ts']  . "</div>
                                                        <div class='orderId'>" . $value['une']  . "</div>
                                                    </div>";
                                                }
                                            }
                                            ?>
                                        </div>
                                        <!--end::Header-->
                                    </div>
                                    <!--end: Card-->
                                    <!--end: List Widget 9-->
                                </div>




                            </div>
                            <!--end::Row-->
                            <!--end::Dashboard-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted font-weight-bold mr-2">2020©</span>
                            <a href="http://keenthemes.com/metronic" target="_blank" class="text-dark-75 text-hover-primary">Keenthemes</a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Nav-->
                        <div class="nav nav-dark">
                            <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-5">About</a>
                            <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-5">Team</a>
                            <a href="http://keenthemes.com/metronic" target="_blank" class="nav-link pl-0 pr-0">Contact</a>
                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->
    <!-- begin::User Panel-->
    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
        <!--begin::Header-->
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
            <h3 class="font-weight-bold m-0">User Profile
                <small class="text-muted font-size-sm ml-2">12 messages</small></h3>
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="offcanvas-content pr-5 mr-n5">
            <!--begin::Header-->
            <div class="d-flex align-items-center mt-5">
                <div class="symbol symbol-100 mr-5">
                    <div class="symbol-label" style="background-image:url('assets/media/users/300_21.jpg')"></div>
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div class="d-flex flex-column">
                    <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?php echo $_SESSION["username"] ?></a>
                    <div class="text-muted mt-1">Application Developer</div>
                    <div class="navi mt-2">
                        <a href="#" class="navi-item">
                            <span class="navi-link p-0 pb-2">
                                <span class="navi-text text-muted text-hover-primary">jm@softplus.com</span>
                            </span>
                        </a>
                        <a onclick='logout()' class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Separator-->
            <div class="separator separator-dashed mt-8 mb-5"></div>
            <!--end::Separator-->
            <!--begin::Separator-->
            <div class="separator separator-dashed my-7"></div>
            <!--end::Separator-->

        </div>
        <!--end::Content-->
    </div>
    <!-- end::User Panel-->
    <script>
        var HOST_URL = "https://keenthemes.com/metronic/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js?v=7.0.5"></script>
    <script src="assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.5"></script>
    <script src="assets/js/scripts.bundle.js?v=7.0.5"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.5"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/js/pages/widgets.js?v=7.0.5"></script>
    <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>