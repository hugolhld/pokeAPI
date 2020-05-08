<?php
    include('./includes/config.php');
    include('./includes/header.php');
    // $url = 'https://pokeapi.co/api/v2/pokemon';
    $limit = '?limit=807/';
    $data = file_get_contents(BASE_URL.$limit);
    $data = json_decode($data);
    // echo '<pre>';
    // // print_r($data->results);
    // print_r(json_decode(file_get_contents('https://pokeapi.co/api/v2/pokemon/25/')));
    // echo '</pre>';
    $alhabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    $letterActive = empty($_GET['letter']) ? 'a' : $_GET['letter'];
?>

        <section class="section__alphabet">
            <h2>Or search alphabetically</h2>
            <div class="button">
                <?php foreach($alhabet as $key => $letter): ?>
                    <a href="?letter=<?= $alhabet[$key] ?>" class="test">
                        <p class="button__alphabet"> <?= $letter ?> </p>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="result__alphabet">
            <?php
                $sortPokemonName =[];
                foreach($data->results as $key => $result)
                {
                    if(substr($result->name, 0, 1) == $letterActive)
                    {
                        array_push($sortPokemonName, $result->name);
                    }
                    asort($sortPokemonName);
                }
                foreach($sortPokemonName as $pokemonName):
            ?>
                    <?php
                        
                        $urlPokemon = BASE_URL.'/'.$pokemonName;
                        $dataPokemon = json_decode(file_get_contents($urlPokemon));
                        $idPokemon = $dataPokemon->id;
                    ?>
                    <a href="pokemon.php?id=<?= $idPokemon ?>" class="result__item">
                        <img src="<?= empty($idPokemon) ? null : "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/$idPokemon.png"?>" alt="">
                        <p> <?= ucfirst($pokemonName) ?> </p>
                    </a>
            <? 
                endforeach;
            ?>
            </div>
        </section>
<?php
    include('./includes/footer.php');
?>