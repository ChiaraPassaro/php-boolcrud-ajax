
<?php

    if(empty($required)){
        include_once '../../functions.php';
       //per non far caricare la pagina direttamente da indirizzo completo
        accessDenied(basename(__FILE__));
    }
    include 'showdb.php';
    if($results){
        $guest[] = $results;
        echo json_encode($guest);
    }

?>
