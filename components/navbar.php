<nav class="navbar fixed-top navbar-expand-lg navbar-light" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="home" style="font-size: 25px;"><img class="dc_logo" src="images/logo/logo_test.png" /><strong style="color:#E8B244;">Rum's</strong><span style="color:#E8B244"> Casino</span></a>
        <button class="btn navbar-toggler border-2 px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <img style="width: 30px" src="responsive_navbar/image/menu-image.png" alt="menu icon">
        </button>
        <div class="offcanvas offcanvas-start-lg" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header d-flex d-lg-none">
                <a class="navbar-brand offcanvas-title" href="#" style="font-size: 25px;"><img class="dc_logo" src="images/logo/logo_test.png" /><strong style="color:#E8B244;">Rum's</strong><span style="color:#E8B244"> Casino</span></a>
                <a href="javascript:void(0) " class="text-reset p-0" data-bs-dismiss="offcanvas" aria-label="close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFFFFF" class="bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </a>
            </div>
            <div class="offcanvas-body p-lg-0">
                <ul class="navbar-nav" id="trg">
                    <li class="nav-item <?php echo ($_SESSION['navbar_option'] == 'blackjack') ? 'active' : ''; ?>">
                        <a href="blackjack" id="blackjack" class="nav-link text-white">Blackjack</a>
                    </li>
                    <li class="nav-item <?php echo ($_SESSION['navbar_option'] == 'baccarat') ? 'active' : ''; ?>">
                        <a href="baccarat" id="baccarat" class="nav-link text-white">Baccarat</a>
                    </li>
                    <li class="nav-item <?php echo ($_SESSION['navbar_option'] == 'roulette') ? 'active' : ''; ?>">
                        <a href="roulette" id="roulette" class="nav-link text-white">Roulette</a>
                    </li>
                    <!-- <li class="nav-item <?php echo ($_SESSION['navbar_option'] == 'poker') ? 'active' : ''; ?>">
                        <a href="poker" id="poker" class="nav-link text-white">Poker</a>
                    </li> -->
                    <li class="nav-item <?php echo ($_SESSION['navbar_option'] == '3cardpoker') ? 'active' : ''; ?>">
                        <a href="3cardpoker" id="poker" class="nav-link text-white">3 Card Poker</a>
                    </li>
                    <li class="nav-item <?php echo ($_SESSION['navbar_option'] == 'myaccount') ? 'active' : ''; ?>">
                        <a href="myaccount" id="myaccount" class="nav-link text-white">My Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    window.onscroll = () => {
        const nav = document.querySelector('#navbar');
        if (this.scrollY <= 10) nav.className = 'navbar fixed-top navbar-expand-lg navbar-light';
        else nav.className = 'navbar fixed-top navbar-expand-lg navbar-light scroll';
    };
</script>