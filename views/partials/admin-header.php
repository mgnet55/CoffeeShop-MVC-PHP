<header>
    <div class="container">
        <div class="logo2">
            <h2><?= env('APP_NAME') ?></h2>
            <i class="bi bi-alarm"></i>
        </div>
        <nav id="navLinks2">
            <ul class="mb-0">
                <li><a href="">Home</a></li>
                <li><a href="orders">Users</a></li>
                <li><a href="products">Products</a></li>
                <li><a href="users">Users</a></li>
                <li><a href="man-orders">Manual Oreders</a></li>
                <li><a href="checks">Checks</a></li>
            </ul>
        </nav>
        <div class="profile">
            <img src="<?=$_SESSION['avatar']?>" width="100px" />
            <p href=""><?=$_SESSION['username'] ?></p>
            <a href="">Logout</a>
        </div>
    </div>
</header>
<body>
<main role="main" class="container">

