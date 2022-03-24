<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= env('APP_NAME') ?></title>
    <meta name="description" content="Order your drink and enjoy in now not later">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="/css/home/bootstrap.min.css">
    <link rel="stylesheet" href="/css/home/animate.min.css">
    <link rel="stylesheet" href="/css/home/animated-headline.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"
          integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="/css/home/style.css">

</head>
<body>
<header class="mb-5">
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header header-sticky">
            <div class="menu-wrapper d-flex align-items-center justify-content-between">
                <div class="header-left d-flex align-items-center">
                    <!-- Logo -->
                    <div class="logo ml-2">
                        <img width="80px" src="/logo.png" alt="<?= env('APP_NAME') ?>"></a>
                    </div>
                        <h2><?= env('APP_NAME') ?></h2>
                    <!-- Main-menu -->
                    <div class="main-menu">
                        <nav>
                            <ul id="navigation d-flex align-items-center">
                                <li><a href="/">Explore</a></li>
                                <li><a href="/orders">My Orders</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Social -->
                <div class="header-right1">
                    <div class="header-social">
                        <?= $_SESSION['name'] ?>
                        <img class="rounded-circle" width="50px" height="50px"
                             src="/uploads/<?= $_SESSION['avatar'] ?>">
                        <a href="/logout"><i class="fa fa-sign-out"></i></a>
                    </div>
                </div>
                <!-- Mobile Menu -->
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none">
                        <ul id="navigation d-flex align-items-center">
                            <li><a href="/">Explore</a></li>
                            <li><a href="/orders">My Orders</a></li>
                            <li><a href="/logout"><i class="fa fa-sign-out"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
<!-- header end -->
<main class="container-fluid">