<?php
require_once './autentica.php';

$q = (isset($_GET["q"]) ? $_GET["q"] : "");
require_once 'DAO/Mesa.php';
$mesa = new Mesa();

if (isset($_POST["delete"])) {
    $mesa->delete($_POST["delete"] );
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TABELA LISTAGEM DE MESAS</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        
        <!-- DataTables-->
        <link href="plugins/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <!--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">-->
        <!--<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>-->

        
    </head>
    
    <body>

        <div class="container">
            
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Convidados&Mesas</a>
            </div>
             <ul class="nav navbar-nav">
                <!--<li class="active"><a href="index.php">Home</a></li>-->
              <li><a href="Tabela_convidado.php" data-toggle="tooltip" title="CLIQUE PARA ACESSAR A LISTA DE CONVIDADOS">Convidados</a></li>
              <li><a href="Tabela_mesas.php" data-toggle="tooltip" title="CLIQUE PARA ACESSAR A LISTA DE MESAS">Mesas</a></li>
              <li><a href="Tabela_montagem.php" data-toggle="tooltip" title="CLIQUE PARA ACESSAR A LISTA DE MONTAGEM DE MESA">Montagem de mesas</a></li>
              <li><a href="Tabela_Consulta_Convidados.php" data-toggle="tooltip" title="CLIQUE PARA CONSULTAR MONTAGEM">Consulta</a></li>
            </ul>
              
              <ul class="nav navbar-nav navbar-right">
                    <?php
                    //session_start();
                    if (isset($_SESSION["login"])) {
                        echo '<li><a href="logout.php">'
                        . $_SESSION["login"]
                        . ' (Logout)</a></li>';
                    } else {
                        echo '<li><a href="login.php">Login</a></li>';
                    }
                    ?>
                </ul>
              
              
          </div>
        </nav>
            
            <h3>TABELA DE MESAS</h3>

            <form method="get" class="form-inline" style="margin-bottom: 10px">
                <div class="input-group">
                    <!--<input class="form-control" type="text" placeholder="Pesquisar" name="q" value="<?php echo $q; ?>">-->
<!--                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" for="q">
                            <span class="glyphicon glyphicon-search"></span>
                        </button> 
                    </span>-->
                </div>
                <a href="<?php echo $q; ?>formmesa.php?acao=incluir" class="btn btn-success">
                    <span class="glyphicon glyphicon-plus"></span>
                    Nova Mesa
                </a>
            </form>
            <table class="table table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Código</th>
                        <th class="text-center">Número da mesa</th>
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Numero de lugares</th>
                        <th class="text-center">Excluir</th>
                    </tr>
                    
                </thead>
                <tbody>
                <form  method="post">
                    <?php
                    $tabela = $mesa->findById($q);

                    foreach ($tabela as $linha) {
                        echo '<tr>'
                        . '<td class="text-center">' 
                        . $linha['idmesa']
                        . '</td>'
                        . '<td><a href="formmesa.php?acao=editar&cod='
                        . $linha['idmesa']
                        . '">'
                        . $linha['mesanumero']
                        . '</a></td>'
                        . '<td class="text-right">  '
                        . $linha['descricao']
                        . '</td>'
                        . '<td class="text-right">  '
                        . $linha['numerodelugares']
                        . '</td>'    
                        . '<td class="text-center">'
                        . '<button type="submit" class="btn btn-link" name="delete" value="'
                        . $linha['idmesa']
                        . '" onclick="return confirm(\'Deseja realmente excluir?\')">'
                        . '<span class="glyphicon glyphicon-trash"></span>'
                        . '</button>'
                        . '</td>'
                        . '</tr>' . "\n";
                        
                    }
                    ?>
                </form>
                </tbody>
            </table>
            
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="bootstrap-dist//js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

        <!--DataTables-->
        <script src="plugins/jquery-1.12.4.js" type="text/javascript"></script>
        <script src="plugins/jquery.dataTables.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
        </script>
        
    </body>
</html>