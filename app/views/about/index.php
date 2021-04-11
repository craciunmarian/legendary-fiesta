<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../TW_UnWe_MVC/public/css/common/common.css">
    <link rel="stylesheet" href="../../../../TW_UnWe_MVC/public/css/about/about_page.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <title>UnWe - Unemployment Web Visualizer</title>
</head>
<body id="body">
    <header>
        <nav class="nav__container" id="nav__container">
            <button class="hamburger" id="hamburger">
                <img src="../../../../TW_UnWe_MVC/public/assets/common/hamburger.svg" class="hamburger__icon" id="hamburger__icon" alt="burger">
                <img src="../../../../TW_UnWe_MVC/public/assets/common/close.svg" class="close__icon" id="close__icon" alt="close">
            </button>
            <ul class="nav__list" id="nav__list">
                <li><a class="header__text" href="../public/home">Acasă</a></li>
                <li><a class="header__text" href="../public/visualizer">Statistici</a></li>
                <li><a class="header__text" href="../public/about">Despre noi</a></li>
            </ul>
        </nav>
    </header>
    <div class="gallery">
        <div class="portrait">
            <img class="portrait__picture" src="../../../../TW_UnWe_MVC/public/assets/about/adana_pfp.png" alt="pic 1">
            <p class="name">Adana Popescu</p>
            <div class="dash"></div>
            <p class="email">adana.popescu22@gmail.com</p>
        </div>
        <div class="portrait">
            <img class="portrait__picture" src="../../../../TW_UnWe_MVC/public/assets/about/adrian_pfp.jpg" alt="pic 2">
            <p class="name">Vătui Adrian</p>
            <div class="dash"></div>
            <p class="email">adrianvatui9989@yahoo.com</p>
        </div>
        <div class="portrait">
            <img class="portrait__picture" src="../../../../TW_UnWe_MVC/public/assets/about/razvan_pfp.jpg" alt="pic 3">
            <p class="name">Crăciun Răzvan</p>
            <div class="dash"></div>
            <p class="email">razvanmariancr@gmail.com</p>
        </div>
    </div>
    <footer>
        <p class="footer__text">filler text</p>
        <p class="footer__text">filler text</p>
    </footer>
    <script src="../../../../TW_UnWe_MVC/public/scripts/about/hamburger.js"></script>
</body>
</html>