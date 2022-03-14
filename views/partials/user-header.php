<header >
    <div class="container">
        <div class="logo2">
            <h2><?=env('APP_NAME')?></h2>
            <i class="bi bi-alarm"></i>
        </div>
        <nav id="navLinks2">
            <ul class="mb-0">
                <li><a href="/">Home</a></li>
                <li><a href="/orders">My Orders</a></li>
            </ul>
        </nav>
        <div class="profile">
            <img src="<?=$_SESSION['avatar']?>" width="100px" />
            <p href=""><?=$_SESSION['name'] ?></p>
            <a href="/logout">Logout</a>
        </div>
    </div>
</header>
<body>
<main role="main" class="container">

