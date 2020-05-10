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
        echo '</pre>';
    }
    else
    {
        echo 'No result for this name';
    }
?>



<?php include('./includes/footer.php'); ?>