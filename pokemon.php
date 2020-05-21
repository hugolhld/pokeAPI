<?php
    include('./includes/config.php');
    include('./components/header.php');
    include('./includes/apiConfig.php');
    $data = new pokeAPI();
    // Passe en lowercase ce qu'on recherche afin de ne pas avoir d'erreurs
    $pokemonId = strtolower($_GET['id']);
    // Recupere les données du pokemon
    $dataID = $data->getDataObject('pokemon', $pokemonId);
    // Recupere les données de où attraper les pokemon
    $dataEncouters = $data->getDataObject('pokemon', $pokemonId.'/encounters');
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

                        <!-- Recupere les abilités du pokémon -->
                        <?php foreach($dataID->abilities as $ability): ?>

                            <!-- Ecris lisiblement les abilités en retirant dans les '-' inutiles -->
                            <li><?= ucwords(ucfirst(str_replace('-',' ',$ability->ability->name))) ?></li>

                        <?php endforeach; ?>

                    </ul>
                </div>
                <!-- Crée un tableau contant tout les stats de base du pokémon -->
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
                        <!-- Recupere toutes les attaques et leurs descriptions -->
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
                    <?php if($dataEncouters): ?>
                        <!-- Recuepre tout les données sur les emplacment du pokémon selon les version des jeux -->
                        <?php foreach($dataEncouters as $place): ?>
                            
                            <p>You can go at <span><?= ucwords(ucfirst(str_replace('-',' ',$place->location_area->name))) ?></span> in the Pokemon version 
                            
                            <!-- Crée un variable pour avoir le nombre des jeux ou les pokemons se trouvent au meme endroit -->
                            <?php $countVersion = count($place->version_details) ?>
                            
                                <?php foreach($place->version_details as $key => $pokemonVersion): ?>

                                    <span> <?= ucfirst(str_replace('-', ' ', $pokemonVersion->version->name)) ?> </span>

                                    <?php 

                                        // Utlise CountVersion pour savoir quand mettre un point, une virgule et de mettre le 'and'
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
                    
                    <!-- Beaucoup de pokémons n'ont pas les 'encounters' de renseigné, alors une petite phrase au cas ou il n'y ait rien -->
                    <?= $dataEncouters ? null : 'Not result found for this pokemon 😔' ?>
                </div>
            <?php endif; ?>

            <!-- si la recherche de pokemon est inexistante ou incorrecte -->
            <?= $dataID ? null : 'Not result found for this pokemon, retry with a new name or ID 😔' ?>
        </div>
            
    </section>

<?php include('./components/footer.php'); ?>