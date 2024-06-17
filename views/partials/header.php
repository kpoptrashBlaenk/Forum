<header class="fixed-top p-3 text-bg-dark">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="/../resources/logo.webp" class="bi me-2" width="50" height="50" role="img" aria-label="Bootstrap" alt="logo">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-white">Home</a></li>
                <li><a href="#dropdown_posts" role="button" data-bs-toggle="collapse" aria-expanded="false"
                       aria-controls="dropdown_posts" class="nav-link px-2 text-white">Posts</a></li>
                <li><a href="/slams/create" class="nav-link px-2 text-white">Create</a></li>
                <li><a href="/contacts" class="nav-link px-2 text-white">Contact</a></li>
            </ul>

            <?php if(!uriPathCheck('/slams')) : ?>
            <form class="col-12 col-lg-3 mb-3 mb-lg-0 me-lg-3" role="search" action="/slams" method="GET">
                <div class="input-group">
                    <button class="btn btn-outline-light" type="submit" id="button-search">Search</button>
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search" name="search">
                </div>
            </form>
            <?php endif; ?>

            <div class="text-end">
                <?php if ($_SESSION['user'] ?? false) : ?>
                    <div class="d-flex align-items-center">
                        <form method="POST" action="/session" class="me-2 mb-0">
                            <input type="hidden" name="_method" value="DELETE"/>
                            <input type="hidden" name="old_uri" value="<?= $_SERVER['REQUEST_URI'] ?>"/>
                            <button type="submit" class="btn btn-outline-light">Logout</button>
                        </form>
                        <a href="/profile?user=<?= $_SESSION['user']['username'] ?>&page=1" class="nav-link px-2 text-white"><?= $_SESSION['user']['username'] ?></a>
                    </div>
                <?php else : ?>
                    <button type="button" class="btn btn-outline-light me-2"><a href="/session" class="nav-link">Login</a></button>
                    <button type="button" class="btn btn-primary"><a href="/register" class="nav-link">Sign-up</a>
                    </button>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <div class="collapse" id="dropdown_posts">
        <ul class="dropdown-menu d-block position-static mx-0 border-0 shadow w-220px" data-bs-theme="dark">
            <li>
                <a class="dropdown-item d-flex gap-2 align-items-center" href="/slams?category=1">
                    <img src="/../resources/HTML5.png" alt="HTML/CSS" width="32" height="32" class="bi">
                    HTML/CSS
                </a>
            </li>
            <li>
                <a class="dropdown-item d-flex gap-2 align-items-center" href="/slams?category=2">
                    <img src="/../resources/Java.png" alt="Java" width="32" height="32" class="bi">
                    Java
                </a>
            </li>
            <li>
                <a class="dropdown-item d-flex gap-2 align-items-center" href="/slams?category=3">
                    <img src="/../resources/Javascript.png" alt="JavaScript" width="32" height="32" class="bi">
                    JavaScript
                </a>
            </li>
            <li>
                <a class="dropdown-item d-flex gap-2 align-items-center" href="/slams?category=4">
                    <img src="/../resources/php.svg" alt="PHP" width="32" height="32" class="bi">
                    PHP
                </a>
            </li>
            <li>
                <a class="dropdown-item d-flex gap-2 align-items-center" href="/slams?category=5">
                    <img src="/../resources/SQL.jpg" alt="SQL" width="32" height="32" class="bi">
                    SQL
                </a>
            </li>
            <li>
                <a class="dropdown-item d-flex gap-2 align-items-center fw-bolder" href="/slams?page=1">
                    <div></div>
                    All
                </a>
            </li>
        </ul>
    </div>
</header>
<h1>_</h1>
