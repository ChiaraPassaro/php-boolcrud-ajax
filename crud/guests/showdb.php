<?php

    //per non far caricare la pagina direttamente da indirizzo completo
    include_once 'functions.php';
    //per non far caricare la pagina direttamente da indirizzo completo
    accessDenied(basename(__FILE__));

    if (!empty($delete_id)) {
        $id = $delete_id;
        $connection = connectDB();
        $query = "DELETE FROM ospiti WHERE id = ?";

        $bind_param_type = "s";
        $bind_param_var = $id;

        $results = modifyData($connection, $query, $bind_param_type, $bind_param_var);

        if ($results > 0) {
            $response = ['status' => 'delete', 'id' => $id];
            return $response;
        } else {
            $response = ['status' => 'not delete'];
            return $response;
        }
    } else {
        $connection = connectDB();
        $query = "SELECT * FROM ospiti WHERE id = ? LIMIT 1";

        $bind_param_type = "s";
        $bind_param_var = (!empty($show_id)) ? $show_id : null;

        $guests = getData($connection, $query, $bind_param_type, $bind_param_var);
        return $guests;
    }




?>

