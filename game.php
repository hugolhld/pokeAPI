<?php
    include('./includes/config.php');
    include('./includes/header.php');
    include('./includes/apiConfig.php');
    $data = new pokeAPI;
    $id = rand(1, 807);
    $dataResult = $data->getDataObject('pokemon', $id)->name;
    $dataResultWin = rand(1,2);
    $dataResultLoos = $dataResultWin === 1 ? 2 : 1;
?>

    <div class="name">
        <h1><?= $dataResult ?></h1>
        <img src="<?= "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/$id.png" ?>" alt="pokemon random">
    </div>

    <div class="reponse">
        <div class="response__choice" data-result="<?= $dataResultWin ?>">
            <p><?= $dataResultWin === 1 ? $dataResult : $data->getDataObject('pokemon', rand(1, 807))->name ?></p>
        </div>
        <div class="response__choice" data-result="<?= $dataResultLoos ?>">
            <p><?= $dataResultLoos === 1 ? $dataResult : $data->getDataObject('pokemon', rand(1, 807))->name ?></p>
        </div>
    </div>
    <a href="game.php" class="next__question">Next question</a>
    <div class="win__div">
        <h3>YOU WIN ! GREAT JOB</h3>
        <a href="game.php" class="win__restart">Restart</a>
    </div>
    <div class="loose__div">
        <h3>YOU LOOSE ! RESTART FOR A BETTER JOB</h3>
        <a href="game.php" class="loose__restart">Restart</a>
    </div>
<?php
    include ('./includes/footer.php');
?>