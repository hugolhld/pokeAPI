<?php
    include('./includes/config.php');
    include('./includes/header.php');
    include('./apiConfig.php');
    $data = new pokeAPI;
    $dataResult = $data->getDataObject('pokemon', rand(1, 807))->name;
    $dataResultWin = rand(1,2);
    $dataResultLoos;
    if($dataResultWin === 1)
    {
        $dataResultLoos = 2;
    }
    else
    {
        $dataResultLoos = 1;
    }
    function test($o){ $dataResult = $o ;}
?>

    <div class="name">
        <h1><?= $dataResult ?></h1>
    </div>

    <div class="reponse">
        <div class="response__choice" data-result="<?= $dataResultWin ?>">
            <p><?= $dataResultWin === 1 ? $dataResult : $data->getDataObject('pokemon', rand(1, 807))->name ?></p>
        </div>
        <div class="response__choice" data-result="<?= $dataResultLoos ?>">
            <p><?= $dataResultLoos === 1 ? $dataResult : $data->getDataObject('pokemon', rand(1, 807))->name ?></p>
        </div>
    </div>
    <a href="game.php">aa</a>
<?php
    include ('./includes/footer.php');
?>