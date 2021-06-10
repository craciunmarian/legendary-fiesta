<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/common/common.css">
    <link rel="stylesheet" href="/css/home/landing_page.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <title>UnWe - Unemployment Web Visualizer</title>
    <meta name="description" content="Generate charts with official unemployment data in Romania">
</head>


<body id="body">
    <img class="image__asset" src="/assets/home/asset-main.png" alt="decorative asset containing a girl on her laptop">
    <header>
        <nav class="nav__container" id="nav__container">
            <button class="hamburger" id="hamburger">
                <img src="/assets/common/hamburger-white.svg" class="hamburger__icon" id="hamburger__icon" alt="burger">
                <img src="/assets/common/close.svg" class="close__icon" id="close__icon" alt="close">
            </button>
            <ul class="nav__list" id="nav__list">
                <li><a class="header__text" href="/home">Acasă</a></li>
                <li><a class="header__text" href="/visualizer">Statistici</a></li>
                <li><a class="header__text" href="/about">Despre noi</a></li>
            </ul>
        </nav>
    </header>

    <h1 class="title text-center">
        Șomajul în România
    </h1>

    <div id="counter-div">
        <img id="someri-icon" src="/assets/home/people_black_24dp.svg" alt="unemployed person icon">
        <h2 class="someri-counter text-center" id="someri-counter"></h2>
    </div>

    <div class="line">
    </div>

    <h2 class="subtitle text-center">
        funcționalități
    </h2>

    <section class="section text-center">
        <div class="icons__text">
            <img class="icons" src="/assets/home/pie-chart.svg" alt="decorative asset containing a pie chart">
            <br>
            Grafice
            <p class="small__text">Acest site generează reprezentări grafice ale statisticilor legate de șomaj, pentru a ușura înțelegerea acestora. </p>
        </div>
        <div class="icons__text">
            <img class="icons" src="/assets/home/analytics.svg" alt="decorative asset representing a statistic visualization">
            <br>
            Filtrare
            <p class="small__text">Poți aplica filtre pentru a vizualiza doar categoriile sau criteriile care te interesează.</p>
        </div>
        <div class="icons__text">
            <img class="icons" src="/assets/home/document.svg" alt="decorative asset in the shape of a document">
            <br>
            Export
            <p class="small__text">În final, poți exporta informațiile filtrate în mai multe formate - PDF și CSV-, pentru a le vizualiza și offline.</p>
        </div>
    </section>
    <script src="/scripts/about/hamburger.js"></script>
    <script src="/scripts/home/home.js"></script>

</body>

</html>