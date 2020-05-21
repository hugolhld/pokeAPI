<?php
    include('./includes/config.php');
    include('./components/header.php');
    include('./includes/apiConfig.php');
    $data = new pokeAPI();
    // Crée un tbaleau avec l'alphabet pour le pourcourir par la suite
    $alhabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    // Inspect dans l'url si il y a une lettre savoir quelle pokémon afficher, et s'il na pas de valeur en guette afficher 'a' par default
    $letterActive = empty($_GET['letter']) ? 'a' : $_GET['letter'];
    // appel la fonction en passsant en paramètre le nombre de pokemon dans lequel chercher et trier grace à la lette active
    $sortPokemonName = $data->getDataAlphabeticIndex('807', $letterActive);
?>

        <section class="section__alphabet">
            <h2>Or search alphabetically</h2>
            <div class="button">

                <!-- Parcours le tableau de l'alphabet et y affiche chaque lettre -->
                <?php foreach($alhabet as $key => $letter): ?>

                    <a href="?letter=<?= $alhabet[$key] ?>" class="test">
                        <p class="button__alphabet"> <?= $letter ?> </p>
                    </a>

                <?php endforeach; ?>

            </div>
            <div class="result__alphabet">

            <!-- Affcihe les pokemons un à un, grace au tableau trier alphabétiquement -->
            <?php foreach($sortPokemonName as $pokemonName): ?>

                <?php $dataPokemon = $data->getDataObject('pokemon', $pokemonName); ?>

                <a href="pokemon.php?id=<?= $dataPokemon->id ?>" class="result__item">
                    <!-- Verifie si il y'a bien une image correspondant au pokemon sinon la prendre sur une autre url -->
                    <img src="<?= empty($dataPokemon->sprites->front_default) ? "https://pokeres.bastionbot.org/images/pokemon/$dataPokemon->id.png" : $dataPokemon->sprites->front_default ?>" alt="<?= $pokemonName ?>">
                    <p> <?= ucfirst($pokemonName) ?> </p>
                </a>

            <? endforeach; ?> 

            </div>
        </section>

<?php include('./components/footer.php'); ?>