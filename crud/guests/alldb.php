<?php

   if(empty($required) && !$_GET['ajax']){
        //per non far caricare la pagina direttamente da indirizzo completo
       echo json_encode (accessDenied(basename(__FILE__)));
       die();
    }

    include_once '../../functions.php';

    $connection = connectDB();
    $query = "SELECT * FROM ospiti ORDER BY id DESC;";
    $results = getData($connection, $query, null, null);
    echo json_encode($results);

?>

