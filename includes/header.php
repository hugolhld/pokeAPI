<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/main.css">
</head>
<body>
    <header>
        <a href="/"><h1>Pokédex</h1></a>
    </header>
    <main>
        <section class="section__form">
            <form action="pokemon.php" method="get">
                <input type="search" name="id" placeholder="Type the name of a pokemon or his ID">
                <button>Search</button>
            </form>
            <h3>Or</h3>
            <a href="pokemon.php?id=<?= rand(0, 807) ?>">Random Pokemon</a>
        </section>