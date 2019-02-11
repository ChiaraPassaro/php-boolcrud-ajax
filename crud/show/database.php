<?php

    //per non far caricare la pagina direttamente da indirizzo completo
    include_once '../../functions.php';
    //per non far caricare la pagina direttamente da indirizzo completo
    accessDenied(basename(__FILE__));

    $connection = connectDB();
    $query = "SELECT * FROM ospiti WHERE id = ? LIMIT 1";

    $bind_param_type = "s";
    $bind_param_var = (!empty($show_id)) ? $show_id : null;

    $results = getData($connection, $query, $bind_param_type, $bind_param_var);
    return $results;
?>

