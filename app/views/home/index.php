<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnWe - Unemployment Web Visualizer</title>
    <link rel="stylesheet" href="/public/css/common/common.css">
    <link rel="stylesheet" href="/public/css/home/landing_page.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

</head>


<body id="body">
    <img class="image__asset" src="/public/assets/home/asset-main.png" alt="decorative asset containing a girl on her laptop">
    <header>
        <nav class="nav__container" id="nav__container">
            <button class="hamburger" id="hamburger">
                <img src="/public/assets/common/hamburger-white.svg" class="hamburger__icon" id="hamburger__icon" alt="burger">
                <img src="/public/assets/common/close.svg" class="close__icon" id="close__icon" alt="close">
            </button>
            <ul class="nav__list" id="nav__list">
                <li><a class="header__text" href="/public/home">Acasă</a></li>
                <li><a class="header__text" href="/public/visualizer">Statistici</a></li>
                <li><a class="header__text" href="/public/about">Despre noi</a></li>
            </ul>
        </nav>
    </header>

    <h1 class="title text-center">
        Șomajul în România
    </h1>

    <div class="line">
    </div>

    <h2 class="subtitle text-center">
        funcționalități
    </h2>

    <section class="section text-center">
        <div class="icons__text">
            <img class="icons" src="/public/assets/home/pie-chart.svg" alt="decorative asset containing a pie chart">
            <br>
            Grafice
            <p class="small__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus quia architecto veniam rem fugit minima ratione error, debitis molestiae vitae facere, modi adipisci. Incidunt accusamus blanditiis id sequi voluptatum corrupti!</p>
        </div>
        <div class="icons__text">
            <img class="icons" src="/public/assets/home/analytics.svg" alt="decorative asset representing a statistic visualization">
            <br>
            Filtrare
            <p class="small__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus quia architecto veniam rem fugit minima ratione error, debitis molestiae vitae facere, modi adipisci. Incidunt accusamus blanditiis id sequi voluptatum corrupti!</p>
        </div>
        <div class="icons__text">
            <img class="icons" src="/public/assets/home/document.svg" alt="decorative asset in the shape of a document">
            <br>
            Export
            <p class="small__text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus quia architecto veniam rem fugit minima ratione error, debitis molestiae vitae facere, modi adipisci. Incidunt accusamus blanditiis id sequi voluptatum corrupti!</p>
        </div>
    </section>
    <script src="/public/scripts/about/hamburger.js"></script>

</body>

</html>