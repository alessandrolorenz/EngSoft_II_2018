<?php
//require_once './autentica.php';

$q = (isset($_GET["q"]) ? $_GET["q"] : "");
require_once 'DAO/Montagem.php';
$montagem = new Montagem();




?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TABELA DE CONSULTAS</title>

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
            <li class="active"><a href="index.php">Home</a></li>
              <!--<li><a href="Tabela_convidado.php">Convidados</a></li>-->
              <!--<li><a href="Tabela_mesas.php">Mesas</a></li>-->
              <!--<li><a href="Tabela_montagem.php">Montagem de mesas</a></li>-->
            </ul>
          </div>
        </nav>
                  
            
            <h3>TABELA DE MONTAGEM DE MESAS</h3>
            
            <table  id="example" class="table table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Nome do convidado</th>
                        <th class="text-center">Número da mesa</th>
                         
                        
                    </tr>                    
                </thead>
                <tbody>
                <form method="post">
                    <?php
                    //$tabela = $mesa->findByNome($q);
                    $tabela = $montagem->findAll();
                    
                    foreach ($tabela as $linha) {
                        echo '<tr>'
                        . '<td class="text-center">  '
                        . $linha['nome']
                        . '</td>'
                                
                        . '<td class="text-center">Mesa '
                        . $linha['mesanumero']
                        . '</a></td>'
                              
                        
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