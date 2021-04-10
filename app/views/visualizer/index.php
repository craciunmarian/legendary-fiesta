<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnWe - Unemployment Web Visualizer</title>
</head>

<body>
    <h1> Selectează un județ </h1>

    <form id="main-form" class="visualizer-form" method="get" action="generated">
        <section class="visualizer-form__judete">
            <select>
                <?php
                foreach ($data as $judet)
                    echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                ?>
            </select>

            <select>
                <?php
                foreach ($data as $judet)
                    echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                ?> </select>

            <select>
                <?php
                foreach ($data as $judet)
                    echo '<option value="' . $judet . '">' . $judet . '</option>', PHP_EOL;
                ?> </select>
        </section>

        <section class="visualizer-form__indemnizare">
            <label>
                <span> Indemnizați </span>
                <input type="checkbox">
            </label>

            <label>
                <span> Neindemnizați </span>
                <input type="checkbox">
            </label>
        </section>

        <section class="visualizer-form__gender">
            <label>
                <span> Femei </span>
                <input type="checkbox">
            </label>

            <label>
                <span> Bărbați </span>
                <input type="checkbox">
            </label>
        </section>

        <section class="visualizer-form__mediu">
            <label>
                <span> Mediu rural </span>
                <input type="checkbox">
            </label>

            <label>
                <span> Mediu urban </span>
                <input type="checkbox">
            </label>
        </section>


        <section class="visualizer-form__period">
            <label>
                <span> Perioada: ultimii </span>
                <select>
                    <?php
                    for ($an = 1; $an < 20; $an++)
                        echo '<option value="' . $an . '">' . $an . '</option>', PHP_EOL;
                    ?>
                </select>
            </label>
            <label>
                <span> ani si </span>
                <select>
                    <?php
                    for ($luna = 0; $luna < 12; $luna++)
                        echo '<option value="' . $luna . '">' . $luna . '</option>', PHP_EOL;
                    ?>
                </select>
                <span> luni </span>
            </label>
        </section>

        <section class="visualizer-form__education">
            <label>
                <span> Nivel de educație (permite alegere multiplă) </span>
                <select multiple>
                    <option value="0"> Toate nivelele de educație </option>
                    <option value="1"> Fără studii </option>
                    <option value="2"> Învățământ primar </option>
                    <option value="3"> Învățământ gimnazial </option>
                    <option value="4"> Învățământ liceal </option>
                    <option value="5"> Învățământ postliceal </option>
                    <option value="6"> Învățământ profesional/arte și meserii </option>
                    <option value="7"> Învățământ universitar </option>
                </select>
            </label>
        </section>

        <section class="visualizer-form__age">
            <label>
                <span> Categoria de vârstă (permite alegere multiplă) </span>
                <select multiple>
                    <option value="0"> Toate categoriile de vârstă </option>
                    <option value="1"> Sub 25 de ani </option>
                    <option value="2"> 25-29 de ani </option>
                    <option value="3"> 30-39 de ani </option>
                    <option value="4"> 40-49 de ani </option>
                    <option value="5"> 50-55 de ani </option>
                    <option value="6"> peste 55 de ani </option>
                </select>
            </label>
        </section>
    </form>

    <!-- doesn't work on IE, need to do some js for this -->
    <input type="submit" form="main-form" value="Export">

</body>

</html>