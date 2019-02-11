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

    include '../../partials/_header.php';


    $this_file = basename(__FILE__);
    $path = getProjectPath($this_file);

    $name = (!empty($_POST['name'])) ?  $_POST['name'] : false;
    $lastname = (!empty($_POST['lastname'])) ?  $_POST['lastname'] : false;
    $date_birth = (!empty($_POST['date_of_birth'])) ?  $_POST['date_of_birth'] : false;
    $document_type = (!empty($_POST['document_type'])) ?  $_POST['document_type'] : false;
    $document_number = (!empty($_POST['document_number'])) ?  $_POST['document_number'] : false;
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
            <h2>Inserisci Ospite</h2>
        </div>
        <form action="<?php echo $path?>database.php" method="post">
            <div class="row">
                <div class="form-group col-6">
                    <label for="name">Nome</label>
                    <input class="form-control <?php if ($_POST['name_error']){ echo 'input-error'; } ?>" type="text" name="name" id="name" value="<?php if ($name){ echo $name; }?>">
                </div>
                <div class="form-group col-6">
                    <label for="lastname">Cognome</label>
                    <input class="form-control <?php if ($_POST['lastname_error']){ echo 'input-error'; } ?>" type="text" name="lastname" id="lastname" value="<?php if ($lastname){ echo $lastname; }?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="date_of_birth">Data di nascita</label>
                    <input class="form-control <?php if ($_POST['date_of_birth_error']){ echo 'input-error'; } ?>" type="date" name="date_of_birth" id="date_of_birth" value="<?php if ($date_birth){ echo $date_birth; }?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="document_type">Tipo di documento</label>
                    <input class="form-control <?php if ($_POST['document_type_error']){ echo 'input-error'; } ?>" name="document_type" id="document_type" list="document" value="<?php if ($document_type){ echo $document_type; }?>">
                    <datalist id="document">
                        <option value="CI">CI</option>
                        <option value="Driver License">Driver License</option>
                    </datalist>
                </div>
                <div class="form-group col-6">
                    <label for="document_number">Numero di documento</label>
                    <input class="form-control <?php if ($_POST['document_number_error']){ echo 'input-error'; } ?>" type="text" name="document_number" id="document_number" value="<?php if ($document_number){ echo $document_number; }?>">
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
