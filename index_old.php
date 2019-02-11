<?php

/*
    Pagina indice con la lista di tutti gli ospiti attualmente presenti in database. Ci
    sarà una tabella con i seguenti campi:
    a. ID
    b. Nome
    c. Cognome
    d. Bottone per cancellare la riga
    e. Bottone per editare la riga
    f. Bottone per visualizzare in una pagina singola la riga
*/

    include_once 'functions.php';
    $this_file = basename(__FILE__);
    $path = getProjectPath($this_file);
    include 'partials/_header.php';
    include 'database.php';


    if(!empty($results)){
        $guests = $results;
    } else {
        echo 'Non sono presenti record';
        die();
    }

    $modified_id = '';

    if(!empty($_POST['id']) && !empty($_POST['message'])){
        $modified_id =  intval($_POST['id']);
        $update_message =  $_POST['message'];
    }

    if(!empty($_POST['delete_message'])){
        $update_message =  $_POST['delete_message'];
    }



    ?>

    <div class="container main">
        <div class="row ">
            <div class="col-10 p-0">
                <h1 class="table-title">Ospiti</h1>
            </div>
            <div class="col-2 text-right p-0">
                <a class="btn btn-primary" href="<?php echo $path ;?>crud/create/create.php">Inserisci un ospite</a>
            </div>
        </div>

        <?php if (!empty($update_message)){ ?>
            <div class="row">
                <div class="alert alert-warning col-12 text-center mt-4" role="alert">
                    <h3><?php echo $update_message; ?></h3>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <table class="table table-prenotazioni">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th colspan="3"></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($guests as $guest){
                            if($modified_id === $guest['id']){
                                $class = 'tr-modified';
                            } else {
                                $class = 'tr';
                            }
                            ?>
                        <tr class="<?php echo $class; ?>">
                            <td><?php echo $guest['id']; ?></td>
                            <td><?php echo $guest['name']; ?></td>
                            <td><?php echo $guest['lastname']; ?></td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo $path ;?>crud/show/show.php/?id=<?php echo $guest['id']; ?>">Visualizza</a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="<?php echo $path ;?>crud/update/update.php/?id=<?php echo $guest['id']; ?>">Modifica</a>
                            </td>
                            <td>
                                <form action="<?php echo $path ;?>crud/delete/database.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $guest['id']; ?>">
                                    <button class="btn btn-danger" type="submit">Elimina</button></form>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
    include 'partials/_footer.php';
?>