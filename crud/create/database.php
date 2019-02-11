<?php
/*
   2. Pagina con form di creazione di un nuovo ospite, che dia la possibilità di
    inserire i seguenti campi:
    a. Nome
    b. Cognome
    c. Data di nascita
    d. Tipo Documento
    e. Numero Documento
*/

    include_once '../../functions.php';
    include_once '../../env.php';

    $path = 'http://' . $path_server . '/' . $path_root . '/';

    $post_arguments = ['name', 'lastname', 'date_of_birth', 'document_type', 'document_number'];
    //Formato data valido 1964-04-02
    $date_format = 'Y-m-d';

    if(!empty($_POST['name'])
        && !empty($_POST['lastname'])
        && !empty($_POST['date_of_birth'])
        && validateDate($_POST['date_of_birth'], $date_format)
        && !empty($_POST['document_type'])
        && !empty($_POST['document_number'])){
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $date_birth = getFormatDate($_POST['date_of_birth'], $date_format);
        $document_type = $_POST['document_type'];
        $document_number = $_POST['document_number'];
    } else {
        //se c'è un errore creo un form che mi segnala gli input sbagliati
        die('error');
      }

    $connection = connectDB();

    $query = "INSERT INTO `ospiti` (`name`, `lastname`, `date_of_birth`, `document_type`, `document_number`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, NOW(), NOW());";
    $bind_param_type = "sssss";
    $bind_param_var = [$name, $lastname, $date_birth, $document_type, $document_number];


    $results = modifyData($connection, $query, $bind_param_type, $bind_param_var);

    if($results > 0){
        //se ho risultati prendo l'ultima riga inserita
        $query = "SELECT * from `ospiti` ORDER BY `id` DESC LIMIT 1;";
        $bind_param_type = "s";
        $bind_param_var = $id;
        $guest = getData($connection, $query, $bind_param_type, $bind_param_var);
    } else {
        die('error');
        //$message = 'Nessuna modifica effettuata';
    }

    echo json_encode($guest);
?>



