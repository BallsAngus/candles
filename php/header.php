<header class="shop_header">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark py-4">
        <div class="container-fluid">
            <img src="https://img.icons8.com/fluency/452/spa-candle.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
            <a class="navbar-brand" href="index.php">
                Kem's Candles
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item px-4">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link" href="#">Featured</a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <form class="d-flex px-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-warning" type="submit">Search</button>
                </form>
                <ul class="navbar-nav">
                    <li id="header-cart" class="nav-item">
                        <a href="cart.php" class="nav-link">
                            <span id="cart-btn" class="fa-inverse fa-solid fa-shopping-cart fa-xl text-decoration-none"></span>
                        </a>
                    </li>
                    <li id="header-acct" class="nav-item dropdown">
                        <a id="acct-btn" class="nav-link dropdown-toggle text-decoration-none" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span id="acct-btn" class="fa-inverse fa-solid fa-user-circle fa-xl text-decoration-none"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end dropdown-menu-dark text-decoration-none" aria-labelledby="navbarDropdown">
                            <?php
                                $acctdb->loginDropdown();
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>