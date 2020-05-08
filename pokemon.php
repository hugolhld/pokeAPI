<?php
    include('./includes/config.php');
    include('./includes/header.php');

    $dataID = $_GET['id'];

    $data = json_decode(@file_get_contents(BASE_URL.'/'.$dataID.'/'));

    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit;
?>



<?php
    include('./includes/footer.php');
?>