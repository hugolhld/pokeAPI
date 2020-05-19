<?php
    include('./includes/config.php');
    include('./includes/header.php');
    include('./includes/apiConfig.php');
    $data = new pokeAPI();
    $pokemonId = strtolower($_GET['id']);
    $dataID = $data->getDataObject('pokemon', $pokemonId);
    $dataTest = $data->getDataObject('pokemon', $pokemonId.'/encounters');
?>

        <section>
            <?php if($dataID): ?>
                <h1><?= ucfirst($dataID->name) ?></h1>
                <img src="<?= $dataID->sprites->front_default === null ? "https://pokeres.bastionbot.org/images/pokemon/$dataID->id.png" : $dataID->sprites->front_default ?>" alt="<?= $dataID->name ?>">
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
                <div class="attack">
                    <h3><?= ucfirst($dataID->name) ?>'s attack on all Pokemon confused</h3>
                    <ul>

                        <?php foreach($dataID->moves as $attack): ?>

                            <li><?= $attack->move->name ?> --> <?= $data->getAttackDescription($attack->move->name) ?></li>

                        <?php endforeach; ?>

                    </ul>
                </div>
                <div class="found">
                    <h3>For found the pokemon</h3>
                    <?php if($dataTest): ?>

                        <?php foreach($dataTest as $place): ?>

                            <h5><?= $place->location_area->name ?></h5>
                            <p>In the pokemon version</p>
                            <ul>

                                <?php foreach($place->version_details as $pokemonVersion): ?>

                                    <li>

                                        Pokemon <?= ucfirst($pokemonVersion->version->name) ?>

                                    </li>

                                <?php endforeach ?>

                            </ul>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    <?= $dataTest ? null : 'Not result found for this pokemon' ?>
                </div>
            <?php endif; ?>
            
            <?= $dataID ? null : 'Not result found for this pokemon, retry with a new name or ID' ?>
        </section>

<?php include('./includes/footer.php'); ?>