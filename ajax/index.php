
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="show-ospiti">

</div>
<script id="table-template" type="text/x-handlebars-template">
   <table class="table">
       <thead>
           <th>ID</th>
           <th>Nome</th>
           <th>Cognome</th>
       </thead>
       <tbody>
           {{#each guests}}
               <tr>
                   <td>{{id}}</td>
                   <td>{{name}}</td>
                   <td>{{lastname}}</td>
                   <td><a href="http://<?php echo $path_server . '/' . $path_root ?>/show/id/{{id}}" class="btn btn-primary btn-show">Visualizza</a></td>
               </tr>
           {{/each}}
       </tbody>
   </table>
</script>
<script id="table-guest-template" type="text/x-handlebars-template">
    <table class="table">
        <thead>
        <th>ID</th>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Data di Nascita</th>
        <th>Tipo di documento</th>
        <th>Numero di documento</th>
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
<script src="http://<?php echo $path_server . '/' . $path_root ?>/dist/js/main.js"></script>
</body>
</html>