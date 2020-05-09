<?php
    include('./includes/config.php');
    include('./includes/header.php');

    $dataID = $_GET['id'];

    $data = json_decode(@file_get_contents(BASE_URL.'/'.$dataID.'/'));

    if($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    else
    {
        echo 'No result for this name';
    }
?>



<?php
    include('./includes/footer.php');
?>