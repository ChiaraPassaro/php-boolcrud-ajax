<?php

    //first version
    /*function getPath(){
        $path_server = $_SERVER['HTTP_HOST'];
        $path_folders = explode('/', $_SERVER['PHP_SELF']);
        $path_folders_number = count($path_folders);
        if($path_folders_number > 0){
            array_pop($path_folders);
            $path = 'http://' . $path_server;
            foreach ($path_folders as $folder){
                $path .= $folder . '/';
            }
            return $path;
        }
        return $path_server;
    }*/

    //ProjectPath by ChiaraEmanuele
    //How to Use
    //$me = basename(__FILE__);
    //echo getProjectPath($me);

    function getProjectPath($calling) {
        $host = $_SERVER['HTTP_HOST'];
        $self = $_SERVER['PHP_SELF'];
        $replace = str_replace($calling, '', $self);

        if(strpos($replace, '//')){
            $replace_new = str_replace('//', '/', $replace);
            return 'http://' . $host . $replace_new;
        }

        return 'http://' . $host . $replace;

    }

    function getPath($calling) {
        $self = $_SERVER['PHP_SELF'];
        $replace = str_replace($calling, '', $self);

        if(strpos($replace, '//')){
            $replace_new = str_replace('//', '/', $replace);
            return $replace_new;
        }

        return $replace;

    }

    function connectDB(){
        include 'env.php';
        try {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $connection = new mysqli($server, $username, $password, $dbname);
            return $connection;
        }
        catch (Exception $e) {
            die ($e);
        }
    }


    // How to
    //  $query = "SELECT * FROM ospiti WHERE id = ?";
    //    $bind_param_type = "s";
    //    $bind_param_var = 55;
    //    $results = getData($connection, $query, $bind_param_type, $bind_param_var);
    function getData($connection, $query, $bind_param_type, $bind_param_var){

        $statement = $connection->prepare($query);

        if(!empty($bind_param_type) && !empty($bind_param_var)){
            if(gettype($bind_param_var) === 'array'){
                $statement->bind_param($bind_param_type, ...$bind_param_var);
            } else {
                $statement->bind_param($bind_param_type, $bind_param_var);
            }
        }

        $statement->execute();
        $result = $statement->get_result();
        $statement->fetch();

        //chiamo la mia funzione che genera array
        $results =  getResults($result);

        //chiudo connessione
        $statement->close();
        return $results;
    }

function modifyData($connection, $query, $bind_param_type, $bind_param_var){

    $statement = $connection->prepare($query);

    if(!empty($bind_param_type) && !empty($bind_param_var)){
        if(gettype($bind_param_var) === 'array'){
            $statement->bind_param($bind_param_type, ...$bind_param_var);
        } else {
            $statement->bind_param($bind_param_type, $bind_param_var);
        }
    }

    $statement->execute();
    $result = $statement->affected_rows;
    $statement->fetch();
    $statement->close();
    return $result;
}

function getResults($result){
    $results = [];

    if ($result->num_rows > 1 ) {
        //var_dump($result);
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    }
    elseif ($result->num_rows === 1) {
        $results = $result->fetch_assoc();
    }
    else{
        //se non ho risultati ritorno un messaggio di errore
        return 'Non ci sono risultati';
    }
    return $results;
}

function validateDate($date, $format)
{
    $this_date = DateTime::createFromFormat($format, $date);
    if($this_date && $this_date->format($format) === $date){
        return $date;
    } else {
        return false;
    }
}

function getFormatDate($date, $format = 'Y-m-d H:i:s')
{
        setlocale(LC_ALL, 'it_IT.UTF-8');
        $temp = date_create_from_format($format, $date);
        return strftime("%Y-%m-%d", $temp->getTimestamp());
}



