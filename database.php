<?php
    include_once 'functions.php';

    $connection = connectDB();
    $query = "SELECT * FROM ospiti ORDER BY id DESC;";
    $results = getData($connection, $query, null, null);
    return $results;
?>

