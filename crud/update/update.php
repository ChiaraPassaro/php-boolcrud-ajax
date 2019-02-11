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

    include '../../partials/_header.php';

    if(!empty($_GET['id']) || !empty($_POST['id'])){
        $connection = connectDB();
        $query = "SELECT * from ospiti WHERE id = ?";
        $bind_params_type = "s";
        $bind_params_var = (!empty($_GET['id'])) ? $_GET['id'] : $_POST['id'];
        $result = getData($connection,$query,$bind_params_type, $bind_params_var);
    }
    elseif(empty($_GET['id']) && empty($_POST['id'])) {
        echo 'Id non passato';
        die();
    }

    $this_file = basename(__FILE__);
    $path = getProjectPath($this_file);
?>
<div class="container">
    <?php if(!empty($_POST)){ //se ho un dato in post c'è un errore?>
        <div class="row">
            <div class="alert alert-warning col-12 text-center mt-4" role="alert">
                <h3><?php echo 'Errore nella compilazione dei dati'; ?></h3>
            </div>
        </div>
    <?php }?>
    <div class="row">
        <h2>Modifica Ospite</h2>
    </div>
        <form action="<?php echo $path; ?>database.php" method="post">
             <div class="row">
                <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                <div class="form-group col-6">
                    <label for="name">Nome</label>
                    <input class="form-control <?php if ($_POST['name_error']){ echo 'input-error'; } ?>" type="text" name="name" id="name" value="<?php echo $result['name']; ?>">
                </div>
                <div class="form-group col-6 ">
                    <label for="lastname">Cognome</label>
                    <input class="form-control <?php if ($_POST['lastname_error']){ echo 'input-error'; } ?>" type="text" name="lastname" id="lastname" value="<?php echo $result['lastname']; ?>">
                </div>
             </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="date_of_birth">Data di nascita</label>
                    <input class="form-control <?php if ($_POST['date_of_birth_error']){ echo 'input-error'; } ?>" type="date" name="date_of_birth" id="date_of_birth" value="<?php echo getFormatDate($result['date_of_birth']);?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="document_type">Tipo di documento</label>
                    <input class="form-control <?php if ($_POST['document_type_error']){ echo 'input-error'; } ?>" type="text" name="document_type" id="document_type" value="<?php echo $result['document_type']; ?>">
                </div>

                <div class="form-group col-6">
                    <label for="document_number">Numero di documento</label>
                    <input class="form-control <?php if ($_POST['document_number_error']){ echo 'input-error'; } ?>" type="text" name="document_number" id="document_number" value="<?php echo $result['document_number']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <input type="submit" class="btn btn-primary" value="Salva">
                </div>
            </div>

        </form>
    </div>

</div>
