<?php
    include 'env.php';
    $path = 'http://' . $path_server .'/'. $path_root;
    include 'partials/_header.php'
?>
<div class="alert display-none"></div>
<div class="show-ospiti">

</div>
<script id="table-template" type="text/x-handlebars-template">
   <table class="table">
       <thead>
           <tr>
               <th>ID</th>
               <th>Nome</th>
               <th>Cognome</th>
               <th colspan="2"></th>
           </tr>
       </thead>
       <tbody>
           {{#each guests}}
               <tr>
                   <td>{{id}}</td>
                   <td>{{name}}</td>
                   <td>{{lastname}}</td>
                   <td><a href="http://<?php echo $path_server . '/' . $path_root ?>/guest/id/{{id}}" class="btn btn-primary btn-show">Visualizza</a></td>
                   <td>
                       <form method="post" action="http://<?php echo $path_server . '/' . $path_root ?>/guest/id/{{id}}">
                           <input type="hidden" name="id" value="{{id}}">
                           <input type="hidden" name="request" value="delete">
                           <input type="submit" class="btn btn-primary btn-delete" value="Cancella">
                       </form>
                     </td>
               </tr>
           {{/each}}
       </tbody>
   </table>
</script>
<script id="table-guest-template" type="text/x-handlebars-template">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Data di Nascita</th>
                <th>Tipo di documento</th>
                <th>Numero di documento</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {{#each guests}}
        <tr>
            <td>{{id}}</td>
            <td>{{name}}</td>
            <td>{{lastname}}</td>
            <td>{{date_of_birth}}</td>
            <td>{{document_type}}</td>
            <td>{{document_number}}</td>
            <td><a href="http://<?php echo $path_server . '/' . $path_root ?>" class="btn btn-primary btn-show-all">Visualizza tutti gli ospiti</a></td>
            <!--<td><a href="http://<?php /*echo $path_server . '/' . $path_root */?>/show/id/{{id}}" class="btn btn-primary btn-show">Visualizza</a></td>-->
        </tr>
        {{/each}}
        </tbody>
    </table>
</script>

<script id="delete-template" type="text/x-handlebars-template">
    {{#if delete}}
        <div class="alert">Hai cancellato l'Ospite ID: {{delete}}</div>
    {{/if}}
    {{#if error}}
        <div class="alert">{{error}}</div>
    {{/if}}

</script>

<script src="http://<?php echo $path_server . '/' . $path_root ?>/dist/js/main.js"></script>
</body>
</html>