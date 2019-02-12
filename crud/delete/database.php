<?php
include_once 'functions.php';
include_once 'env.php';

$path = 'http://' . $path_server . '/' . $path_root . '/';

if (!empty($delete_id)) {
    $id = $delete_id;
} else {
    die('Id non passato');
}

$connection = connectDB();
$query = "DELETE FROM ospiti WHERE id = ?";

$bind_param_type = "s";
$bind_param_var = $id;

$results = modifyData($connection, $query, $bind_param_type, $bind_param_var);
if ($results > 0) {
    $response = ['status' => 'delete', 'id' => $id];
    echo json_encode($response);
} else {
    $response = ['status' => 'not delete'];
    echo json_encode($response);
}

?>