<?php

/*
    Pagina con un form che permetta di aggiornare un ospite nei seguenti campi
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

    if(!empty($_POST['id'])
    && !empty($_POST['name'])
    && !empty($_POST['lastname'])
    && !empty($_POST['date_of_birth'])
    && validateDate($_POST['date_of_birth'], $date_format)
    && !empty($_POST['document_type'])
    && !empty($_POST['document_number'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $date_birth = getFormatDate($_POST['date_of_birth']);
        $document_type = $_POST['document_type'];
        $document_number = $_POST['document_number'];
    } else {
    //se c'è un errore creo un form che mi segnala gli input sbagliati
    ?>
            <form action="update.php" method="post" id="updated-form">
                <?php
                //se non c'è un campo invio errore altrimenti rinvio il dato
                foreach ($post_arguments as $argument){
                    if(empty($_POST[$argument])){
                        echo  "<input type='hidden' name='" . $argument . "_error' value='true'>";
                    }
                }
                ?>

                <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            </form>
        </div>
    </div>
    <script src="../../dist/js/main.js"></script>

    <?php return; }

    $connection = connectDB();
    $query = "UPDATE `ospiti` SET `name` = ?, `lastname` = ?, `date_of_birth` = ?, `document_type` = ?, `document_number` = ? WHERE `id` = ?";
    $bind_param_type = "ssssss";
    $bind_param_var = [$name, $lastname, $date_birth, $document_type, $document_number, $id];


    $results = modifyData($connection, $query, $bind_param_type, $bind_param_var);
    if($results > 0){
        $query = "SELECT * from `ospiti` WHERE `id` = ?";
        $bind_param_type = "s";
        $bind_param_var = $id;
        $guest = getData($connection, $query, $bind_param_type, $bind_param_var);
    } else {
        $message = 'Nessuna modifica effettuata';
    }
?>
    <div class="container">
        <div class="row">
            <?php
        if(!empty($message)){ ?>
            <h1><?php echo $message; ?></h1>
        <?php }
        else { ?>
            <form action="<?php echo $path; ?>index.php" method="post" id="updated-form">
                <input type="hidden" name="id" value="<?php echo $guest['id']; ?>">
                <input type="hidden" name="message" value="L'ospite con ID <?php echo $guest['id']; ?> è stato modificato">
            </form>
        <?php } ?>

        </div>
    </div>

<script src="../../dist/js/main.js"></script>


