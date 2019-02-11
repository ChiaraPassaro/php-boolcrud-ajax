<?php
    $connection = connectDB();
    $query = "SELECT * FROM ospiti WHERE id = ? LIMIT 1";

    $bind_param_type = "s";
    $bind_param_var = (!empty($_GET['id'])) ? $_GET['id'] : null;

    $results = getData($connection, $query, $bind_param_type, $bind_param_var);
    return $results;
?>

