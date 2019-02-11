<?php
    include_once '../../functions.php';
    include_once '../../env.php';

    $path = 'http://' . $path_server . '/' . $path_root . '/';

    if(!empty($_POST['id'])){
        $id = $_POST['id'];
    } else {
        die('Id non passato');
    }

    $connection = connectDB();
    $query = "DELETE FROM ospiti WHERE id = ?";

    $bind_param_type = "s";
    $bind_param_var = $id;

    $results = modifyData($connection, $query, $bind_param_type, $bind_param_var);
    if($results > 0){

    } else {
        $message = 'Operazione non effettuata';
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
                <input type="hidden" name="delete_message" value="L'ospite con ID <?php echo $id ?> è stato eliminato">
            </form>
        <?php } ?>

        </div>
    </div>

<script src="../../dist/js/main.js"></script>



