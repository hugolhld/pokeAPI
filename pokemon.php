<?php
    include('./includes/config.php');
    include('./components/header.php');
    include('./includes/apiConfig.php');
    $data = new pokeAPI();
    $pokemonId = strtolower($_GET['id']);
    $dataID = $data->getDataObject('pokemon', $pokemonId);
    $dataTest = $data->getDataObject('pokemon', $pokemonId.'/encounters');
?>

    <section>
        <div class="pokemon__container">
            <?php if($dataID): ?>
                <h1><?= ucfirst($dataID->name) ?></h1>
                <img src="<?= "https://pokeres.bastionbot.org/images/pokemon/$dataID->id.png" == null ? $dataID->sprites->front_default : "https://pokeres.bastionbot.org/images/pokemon/$dataID->id.png"  ?>" alt="<?= $dataID->name ?>">
                <h3>Type: <?= ucfirst($dataID->types[0]->type->name). ' / ID: '.$dataID->id ?></h3>
                <div class="pokemon__abilities">
                    <h3>Abilities of <?= ucfirst($dataID->name) ?></h3>
                    <ul>

                        <?php foreach($dataID->abilities as $ability): ?>

                            <li><?= ucwords(ucfirst(str_replace('-',' ',$ability->ability->name))) ?></li>

                        <?php endforeach; ?>

                    </ul>
                </div>
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
                <div class="pokemon__attack">
                    <h3><?= ucfirst($dataID->name) ?>'s attack on all Pokemon confused</h3>
                    <table>

                        <?php foreach($dataID->moves as $attack): ?>
                            
                            <tr>
                                <th><?= ucwords(ucfirst(str_replace('-', ' ',$attack->move->name))) ?></th>
                                <td><?= $data->getAttackDescription($attack->move->name) ?></td>
                            </tr>

                        <?php endforeach; ?>

                    </table>
                </div>
                <div class="pokemon__found">
                    <h3>For found the pokemon</h3>
                    <?php if($dataTest): ?>

                        <?php foreach($dataTest as $place): ?>
                            
                            <p>You can go at <span><?= ucwords(ucfirst(str_replace('-',' ',$place->location_area->name))) ?></span> in the Pokemon version 
                            
                            <?php $countVersion = count($place->version_details) ?>
                            
                                <?php foreach($place->version_details as $key => $pokemonVersion): ?>

                                    <span> <?= ucfirst(str_replace('-', ' ', $pokemonVersion->version->name)) ?> </span>

                                    <?php 

                                        if(++$key === $countVersion - 1)
                                        {
                                            echo 'and';
                                        }
                                        else if(++$key === $countVersion + 1)
                                        {
                                            echo '.';
                                        }
                                        else
                                        {
                                            echo ',';
                                        }

                                    ?>

                                <?php endforeach ?>

                            GOOD LUCK !</p>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    <?= $dataTest ? null : 'Not result found for this pokemon 😔' ?>
                </div>
            <?php endif; ?>
            <?= $dataID ? null : 'Not result found for this pokemon, retry with a new name or ID 😔' ?>
        </div>
            
    </section>

<?php include('./components/footer.php'); ?>