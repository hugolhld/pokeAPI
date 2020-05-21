<?php
    include('./includes/config.php');
    include('./components/header.php');
    include('./includes/apiConfig.php');
    $data = new pokeAPI;
    $id = rand(1, 807);
    $dataResult = $data->getDataObject('pokemon', $id)->name;
    $dataResultWin = rand(1,2);
    $dataResultLoos = $dataResultWin === 1 ? 2 : 1;
?>

    <div class="game__container">

        <div class="game__name">
            <img src="<?= "https://pokeres.bastionbot.org/images/pokemon/$id.png" ?>" alt="pokemon random">
        </div>

        <div class="game__response">
            <div class="response__choice" data-result="<?= $dataResultWin ?>">
                <p><?= ucfirst($dataResultWin === 1 ? $dataResult : $data->getDataObject('pokemon', rand(1, 807))->name) ?></p>
            </div>
            <div class="response__choice" data-result="<?= $dataResultLoos ?>">
                <p><?= ucfirst($dataResultLoos === 1 ? $dataResult : $data->getDataObject('pokemon', rand(1, 807))->name) ?></p>
            </div>
        </div>

        <div class="game__score">
            <div class="score__game">
                <h5>Question: <span>0</span> / 10</h5>
            </div>
            <div class="score__player">
                <h5>Your score: <span>0</span> / 10</h5>
                <small>You need a minimum of 7 points for win</small>
            </div>
        </div>

        <a href="game.php" class="game__next__question">Next question</a>
        
        <div class="game__end_game_result win__div">
            <h3>YOU WIN ! GREAT JOB</h3>
            <a href="game.php" class="win__restart">Restart</a>
        </div>
        <div class="game__end_game_result loose__div">
            <h3>YOU LOOSE ! RESTART FOR A BETTER JOB</h3>
            <a href="game.php" class="loose__restart">Restart</a>
        </div>

    </div>

<?php
    include ('./components/footer.php');
?>