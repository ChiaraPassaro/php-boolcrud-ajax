<?php
include 'env.php';
include 'functions.php';

//prendo il percorso richiesto
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
$request_uri_folders = explode('/', $_SERVER['REQUEST_URI']);
//var_dump($request_uri_folders);

//prendo il path di index
$path_index = getPath(basename(__FILE__));

//Salvo le variabili che portano alle varie pagine
$ajax_path = 'ajax/index.php';
$show_path = 'crud/guests/show.php';
$show_id_url = null;

//divido il percorso se c'è id
if(!empty($request_uri_folders[3]) && $request_uri_folders[3] === 'id'){
    if(!empty($_POST['request']) && $_POST['request'] === 'delete'){
        $delete_id = $request_uri_folders[4];
    }
    if($request_uri_folders[2] === 'guest'){
        $show_id_url = $path_index . 'guest/id/' . $request_uri_folders[4];
        $show_id = $request_uri_folders[4];
    }
}

switch ($request_uri[0]) {
    // Home page
    case $path_index:
        $required = true;
        require $ajax_path;
        break;
    case $show_id_url:
        $required = true;
        require $show_path;
        break;
    case 'ajax':
        require $ajax_path;
        break;   
    default:
        header('HTTP/1.0 404 Not Found');
        require '404.php';
        break;
}
