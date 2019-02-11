
<?php
    include_once '../../functions.php';
   //per non far caricare la pagina direttamente da indirizzo completo
    accessDenied(basename(__FILE__));

     include 'database.php';
    if($results){
       echo json_encode($results);
    }

?>
