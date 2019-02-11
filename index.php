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
$show_path = 'crud/show/show.php';
$create_path = 'crud/create/database.php';
$show_id_url = null;
$create_url = null;

if($request_uri_folders[2] === 'create'){
    $create_url = $path_index . 'create';
}

//divido il percorso se c'è id
if(!empty($request_uri_folders[3]) && $request_uri_folders[3] === 'id'){
    if($request_uri_folders[2] === 'show'){
        $show_id_url = $path_index . 'show/id/' . $request_uri_folders[4];
        $show_id = $request_uri_folders[4];
    }
}

switch ($request_uri[0]) {
    // Home page
    case $path_index:
        require 'home.php';
        break;
    case $show_id_url:
        require $show_path;
        break;
    case $create_url:
        require $create_path;
        break;
    case 'ajax':
        require $ajax_path;
        break;   
    default:
        header('HTTP/1.0 404 Not Found');
        require '404.php';
        break;
}

