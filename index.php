<?php
    include('./includes/config.php');
    include('./components/header.php');
    include('./includes/apiConfig.php');
    $data = new pokeAPI();
    $alhabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    $letterActive = empty($_GET['letter']) ? 'a' : $_GET['letter'];
    $sortPokemonName = $data->getDataAlphabeticIndex('807', $letterActive);
?>

        <section class="section__alphabet">
            <h2>Or search alphabetically</h2>
            <div class="button">

                <?php foreach($alhabet as $key => $letter): ?>

                    <a href="?letter=<?= urlencode($alhabet[$key]) ?>" class="test">
                        <p class="button__alphabet"> <?= $letter ?> </p>
                    </a>

                <?php endforeach; ?>

            </div>
            <div class="result__alphabet">

            <?php foreach($sortPokemonName as $pokemonName): ?>

                <?php
                    $dataPokemon = $data->getDataObject('pokemon', $pokemonName);
                    $idPokemon = $dataPokemon->id;
                ?>

                <a href="pokemon.php?id=<?= urlencode($idPokemon) ?>" class="result__item">
                    <img src="<?= empty($idPokemon) ? null : "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/$idPokemon.png" ?>" alt="<?= $pokemonName ?>">
                    <p> <?= ucfirst($pokemonName) ?> </p>
                </a>

            <? endforeach; ?> 

            </div>
        </section>

<?php include('./components/footer.php'); ?>