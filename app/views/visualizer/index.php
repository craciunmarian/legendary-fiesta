<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/common/common.css">
    <link rel="stylesheet" href="/css/visualizer/visualizer.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <title>UnWe - Unemployment Web Visualizer</title>
</head>

<body id="body">
    <header>
        <nav class="nav__container" id="nav__container">
            <button class="hamburger" id="hamburger">
                <img src="/assets/common/hamburger.svg" class="hamburger__icon" id="hamburger__icon" alt="burger">
                <img src="/assets/common/close.svg" class="close__icon" id="close__icon" alt="close">
            </button>
            <ul class="nav__list" id="nav__list">
                <li><a class="header__text" href="/home">Acasă</a></li>
                <li><a class="header__text" href="/visualizer">Statistici</a></li>
                <li><a class="header__text" href="/about">Despre noi</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1 class="subtitle"> criterii </h1>

        <div class="form-categories">
            <label>
                <input type="radio" id="general" name="categories" class="category-btn">
                <span>Generale</span>
            </label>
            <labeL>
                <input type="radio" id="education" name="categories" class="category-btn">
                <span>Nivel de educație</span>
            </labeL>
            <label>
                <input type="radio" id="age" name="categories" class="category-btn">
                <span>Vârstă</span>
            </label>
            <label>
                <input type="radio" id="environment" name="categories" class="category-btn">
                <span>Medii de rezidență</span>
            </label>
        </div>

        <form id="general-form" class="visualizer-form" method="get" action="/visualizer/generated">

            <section class="visualizer-form__judete">
                <select name="county1">
                    <?php
                    foreach ($data as $judet)
                        echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                    ?>
                </select>

                <select name="county2">
                    <?php
                    foreach ($data as $judet)
                        echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                    ?> </select>

                <select name="county3">
                    <?php
                    foreach ($data as $judet)
                        echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                    ?> </select>
            </section>

            <section class="visualizer-form__2-checkboxes">
                <input name="women" id="femei" type="checkbox">
                <label for="femei"> Femei </label>

                <input name="men" id="barbati" type="checkbox">
                <label for="barbati"> Bărbați </label>
            </section>

            <section class="visualizer-form__2-checkboxes">
                <input name="compensated" id="indemnizati" type="checkbox">
                <label for="indemnizati">Indemnizați</label>

                <input name="unpaid" id="neindemnizati" type="checkbox">
                <label for="neindemnizati"> Neindemnizați </label>
            </section>

            <section class="visualizer-form__2-checkboxes">
                <input name="women-rate" id="percent-femei" type="checkbox">
                <label for="percent-femei">% Femei</label>

                <input name="men-rate" id="percent-barbati" type="checkbox">
                <label for="percent-barbati"> % Bărbați </label>
            </section>

            <label>
                <span>Începând cu data de:</span>
                <input class="start-date" name="start-date" type="month">
            </label>


            <section class="visualizer-form__manner">
                <label>
                    <input name="manner" type="radio" checked value="bar">
                    <span> Bar chart </span>
                </label>

                <label>
                    <input name="manner" type="radio" value="pie">
                    <span> Test </span>
                </label>

                <label>
                    <input name="manner" type="radio" value="line">
                    <span> Line Chart </span>
                </label>
            </section>
        </form>

        <form id="education-form" class="visualizer-form hidden" method="get" action="/visualizer/generated">

            <section class="visualizer-form__judete">
                <select name="county1">
                    <?php
                    foreach ($data as $judet)
                        echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                    ?>
                </select>

                <select name="county2">
                    <?php
                    foreach ($data as $judet)
                        echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                    ?> </select>

                <select name="county3">
                    <?php
                    foreach ($data as $judet)
                        echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                    ?> </select>
            </section>

            <section class="visualizer-form__2-checkboxes">
                <input name="education[]" id="no_studies" type="checkbox" value="none">
                <label for="no_studies"> Fără studii </label>

                <input name="education[]" id="primary" type="checkbox" value="primary">
                <label for="primary"> Învățământ primar </label>
            </section>

            <section class="visualizer-form__2-checkboxes">
                <input name="education[]" id="middle" type="checkbox" value="middle">
                <label for="middle">Învățământ gimnazial</label>

                <input name="education[]" id="high" type="checkbox" value="high">
                <label for="high"> Învățământ liceal </label>
            </section>

            <section class="visualizer-form__2-checkboxes">
                <input name="education[]" id="post-secondary" type="checkbox" value="post-secondary">
                <label for="post-secondary"> Învățământ postliceal </label>
                <input name="education[]" id="uni" type="checkbox" value="uni">
                <label for="uni"> Învățământ universitar </label>
            </section>

            <section class="visualizer-form__1-checkbox">
                <input name="education[]" id="professional" type="checkbox" value="professional">
                <label for="professional"> Învățământ profesional/arte și meserii </label>
            </section>

            <label>
                <span>Începând cu data de:</span>
                <input class="start-date" name="start-date" type="month">
            </label>


            <section class="visualizer-form__manner">
                <label>
                    <input name="manner" type="radio" checked value="bar">
                    <span> Bar chart </span>
                </label>

                <label>
                    <input name="manner" type="radio" value="pie">
                    <span> Test </span>
                </label>

                <label>
                    <input name="manner" type="radio" value="line">
                    <span> Line Chart </span>
                </label>
            </section>
        </form>

        <form id="age-form" class="visualizer-form hidden" method="get" action="/visualizer/generated">

            <section class="visualizer-form__judete">
                <select name="county1">
                    <?php
                    foreach ($data as $judet)
                        echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                    ?>
                </select>

                <select name="county2">
                    <?php
                    foreach ($data as $judet)
                        echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                    ?> </select>

                <select name="county3">
                    <?php
                    foreach ($data as $judet)
                        echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                    ?> </select>
            </section>

            <section class="visualizer-form__2-checkboxes">
                <input name="age[]" id="under 25" type="checkbox" value="under 25">
                <label for="under 25"> Sub 25 de ani </label>

                <input name="age[]" id="25-29" type="checkbox" value="25-29">
                <label for="25-29"> 25-29 de ani </label>
            </section>

            <section class="visualizer-form__2-checkboxes">
                <input name="age[]" id="30-39" type="checkbox" value="30-39">
                <label for="30-39"> 30-39 de ani </label>

                <input name="age[]" id="40-49" type="checkbox" value="40-49">
                <label for="40-49">40-49 de ani </label>
            </section>

            <section class="visualizer-form__2-checkboxes">
                <input name="age[]" id="50-55" type="checkbox" value="50-55">
                <label for="50-55"> 50-55 de ani </label>

                <input name="age[]" id="over 55" type="checkbox" value="over 55">
                <label for="over 55"> peste 55 de ani </label>
            </section>

            <label>
                <span>Începând cu data de:</span>
                <input class="start-date" name="start-date" type="month">
            </label>


            <section class="visualizer-form__manner">
                <label>
                    <input name="manner" type="radio" checked value="bar">
                    <span> Bar chart </span>
                </label>

                <label>
                    <input name="manner" type="radio" value="pie">
                    <span> Test </span>
                </label>

                <label>
                    <input name="manner" type="radio" value="line">
                    <span> Line Chart </span>
                </label>
            </section>
        </form>

        <!-- TODO rework this -->
        <form id="environment-form" class="visualizer-form hidden" method="get" action="/visualizer/generated">

            <section class="visualizer-form__judete">
                <select name="county1">
                    <?php
                    foreach ($data as $judet)
                        echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                    ?>
                </select>

                <select name="county2">
                    <?php
                    foreach ($data as $judet)
                        echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                    ?> </select>

                <select name="county3">
                    <?php
                    foreach ($data as $judet)
                        echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                    ?> </select>
            </section>

            <section class="visualizer-form__2-checkboxes">
                <input name="rural-women" id="rural-women" type="checkbox">
                <label for="under 25"> Femei din mediul rural </label>

                <input name="rural-men" id="rural-men" type="checkbox">
                <label for="rural-men"> Bărbați din mediul rural </label>
            </section>

            <section class="visualizer-form__2-checkboxes">
                <input name="urban-women" id="urban-women" type="checkbox">
                <label for="urban-women"> Femei din mediul urban </label>

                <input name="urban-men" id="urban-men" type="checkbox">
                <label for="urban-men"> Bărbați din mediul urban </label>
            </section>

            <label>
                <span>Începând cu data de:</span>
                <input class="start-date" name="start-date" type="month">
            </label>


            <section class="visualizer-form__manner">
                <label>
                    <input name="manner" type="radio" checked value="bar">
                    <span> Bar chart </span>
                </label>

                <label>
                    <input name="manner" type="radio" value="pie">
                    <span> Test </span>
                </label>

                <label>
                    <input name="manner" type="radio" value="line">
                    <span> Line Chart </span>
                </label>
            </section>
        </form>

        <!-- doesn't work on IE, need to do some js for this -->
        <input class="export-btn" id="export-btn" type="submit" form="general-form" value="Generate">

    </main>
    <script src="/scripts/about/hamburger.js"></script>
    <script src="/scripts/visualizer/visualizer.js"></script>

</body>

</html>