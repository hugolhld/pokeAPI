<!-- Lance un chrono pour savoir combien de temps la page met à charger -->
<?php $time = microtime(TRUE) ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style/main.css">
</head>
<body>
    <header>
        <div class="header__container">
            <a href="/"><h1>Pokédex</h1></a>
            <a href="game.php" class="header__button_game">Test your knowledges in Pokemon</a>
        </div>
    </header>
    <main>
        <section class="section__form">
            <form action="pokemon.php" method="get">
                <input type="search" name="id" placeholder="Type the name of a pokemon or his ID">
                <button>Search</button>
            </form>
            <h3>Or</h3>

            <!-- Envoie sur une page pokemon.php aléatoire -->
            <a href="pokemon.php?id=<?= rand(0, 807) ?>">Random Pokemon</a>
        </section>