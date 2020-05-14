<?php
    include('./includes/config.php');
    include('./includes/header.php');
    include('./apiConfig.php');
    $data = new pokeAPI();
    $dataID = $data->getDataObject('pokemon', $_GET['id']);
    // $dataID = $_GET['id'];

    // $data = json_decode(@file_get_contents(BASE_URL.'/'.$dataID.'/'));

    if($dataID)
    {
        echo '<pre>';
        print_r($dataID);
        // print_r($dataID->moves[60]->move->name);
        echo '</pre>';
    }
    else
    {
        echo 'No result for this name';
    }
?>

        <section>
            <h1><?= ucfirst($dataID->name) ?></h1>
            <img src="<?= $dataID->sprites->front_default ?>" alt="<?= $dataID->name ?>">
            <h3>Type: <?= ucfirst($dataID->types[0]->type->name). ' / ID: '.$dataID->id ?></h3>
            <table>
                <tr>
                    <th>Abilities of <?= ucfirst($dataID->name) ?></th>
                </tr>
                <tr>
                    <?php foreach($dataID->abilities as $ability): ?>
                        <td><?= $ability->ability->name ?></td>
                    <?php endforeach; ?>
                </tr>
            </table>
            <table>
                <tr>

                    <?php foreach($dataID->stats as $statName): ?>

                        <th><?= ucfirst($statName->stat->name) ?></th>

                    <?php endforeach; ?>

                </tr>
                <tr>

                    <?php foreach($dataID->stats as $statName): ?>

                        <td><?= ucfirst($statName->base_stat) ?></td>

                    <?php endforeach; ?>

                </tr>
            </table>
            <h3><?= ucfirst($dataID->name) ?>'s attack on all Pokemon confused</h3>
            <div class="attack">
                <ul>
                    <?php foreach($dataID->moves as $attack): ?>
                        <li><?= $attack->move->name ?> --> <?= $data->getAttackDescription($attack->move->name) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>

<?php include('./includes/footer.php'); ?>