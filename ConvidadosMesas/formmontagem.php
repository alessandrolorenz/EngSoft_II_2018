<?php
require_once './autentica.php';
require_once 'DAO/Montagem.php';
require_once 'DAO/Mesa.php';
require_once 'DAO/Convidado.php';

$montagem = new Montagem();
$mesa = new Mesa();
$convidado = new Convidado();


$acao = $_GET["acao"] ?? "";

if ($acao == 'incluir' && isset($_POST['salvar'])) {
    $idmesa= $_POST['idmesa'];
    $idconvidado = $_POST['idconvidado'];
   
    $montagem->findAll();
    
    
    
    
    
    if ($montagem->insert($idmesa, $idconvidado)) {
        header('Location: Tabela_montagem.php');
        exit();
        
    }else{
        $cod=$idconvidado;
        $convidado->findByCod1($cod);
        //print_r($convidado);
        //echo $convidado;
       
        
        echo '<h1> O convidado '.  $idconvidado . $convidado  .' ja está acomodado em uma mesa </h1>';
    }
    
    
    
    
    
    
  
    
}


if ($acao == 'editar' && isset($_POST['salvar'])) {
    
    if ($montagem->update($_GET['cod'], $_POST['idmesa'], $_POST['idconvidado'])) {
        header('Location: Tabela_montagem.php');
        exit();
    }else{
        //echo '<h1> Deu ruim no update </h1> ' . $_GET['cod'];
        echo '<h1> O convidado '.  $_POST['idconvidado']  .' ja está acomodado em uma mesa </h1>';
    }
}

if ($acao == 'editar' && isset($_GET['cod'])) {
    $linha = $montagem->findByCod($_GET['cod']);
}else{
        
    //echo '<h1> Deu ruim no find </h1> ';
    }



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Montagem</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- DataTables-->
        <link href="plugins/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <!--<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">-->
        <!--<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>-->

        
        
    </head>
    <body class="container">
        
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Convidados&Mesas</a>
            </div>
            <ul class="nav navbar-nav">
                <!--<li class="active"><a href="#">Home</a></li>-->
              <!--<li><a href="Tabela_convidado.php">Convidados</a></li>-->
              <!--<li><a href="Tabela_mesas.php">Mesas</a></li>-->
              <li><a href="Tabela_montagem.php">Voltar para a Listagem de Montagem de mesas</a></li>
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
        
        <h3>
            <?php echo ($acao == "incluir" ? "Novo Montagem" : "Alterar Montagem") ?>
        </h3>
        
        <form method="post" class="form-horizontal">
            
            <div class="form-group">
               
                <label class="control-label">
                    Numero da mesa
                </label>
                <select name="idmesa" required="" class="form-control">
                    
                  
                   
                    <option value="">Selecione a mesa</option>
                    
                    <?php
                    
                    
                    foreach ($mesa->findAll() as $cat) {
                        echo '<option '
                        . ($linha['idmesa'] == $cat['idmesa'] ? " selected " : "")
                        . ' value="'
                        . $cat['idmesa']
                        . '">'
                        .  "Mesa Número: <h1>" . $cat['mesanumero'] .  "</h1> Número de Lugares: " . $cat['numerodelugares'] . "     - Convidados na mesa: " . $montagem->findCountConvidado($idmesa=$cat['idmesa']) 
                        . ($montagem->findCountConvidado($idmesa=$cat['idmesa']) < $cat['numerodelugares'] ? " [Mesa Disponivel] " : " [Mesa cheia (cuide para não exceder o numero de lugares)]")
                                
                                // . ($acao == "incluir" ? "Novo Montagem" : "Alterar Montagem")  
                        
                        . '</option>';
                       }
                       
                    ?>
                    
                </select>
            </div>
            
            
            
            <div class="form-group">
                <label class="control-label">
                    Convidado
                </label>
                
                <?php
                
                ?>
                
                
                <select name="idconvidado" required="" class="form-control">
                    <option value="">Selecione o convidado</option>
                    
                        <?php
                    $mont = $montagem->findAll();

                if ($acao == 'editar'){
                    
                        
                        //echo "<p>Disponíveis</p>";
                       
                       foreach ($convidado->findAllNaoContendo() as $cat) {   
                            echo
   
                        '<option '
                        . ($linha['idconvidado'] == $cat['idconvidado'] ? " selected " : "")
                        . ' value="'
                         . $cat['idconvidado']
                       
                        . '"> - Convidado Disponivel:  ' 
                        .  $cat['nome']        
                        
                        . '</option>';
                       
                       }
                       foreach ($convidado->findAll() as $cat) {            
                        echo
   
                        '<option '
                        . ($linha['idconvidado'] == $cat['idconvidado'] ? " selected " : "")
                        . ' value="'
                        . $cat['idconvidado']
                        . '">'
                        .  $cat['nome'] . " -INDISPONÍVEL"
                        //. ($montagem->findByConv($idconvidado=$linha['idconvidado']) == $cat['idconvidado'] ? " selected " : "gfd")
                        
                        . '</option>';
                       
                            
   
                        }
                       
                       
                       
                    
                    } else {
                        
                            foreach ($convidado->findAllNaoContendo() as $cat) {   
                            echo
   
                        '<option '
                        . ($linha['idconvidado'] == $cat['idconvidado'] ? " selected " : "")
                        . ' value="'
                         . $cat['idconvidado']
                       
                        . '"> - Convidado disponivel:  ' 
                        .  $cat['nome']        
                        
                        . '</option>';
                            
   
                        }
        
                    }
//                    foreach ($convidado->findAllNaoContendo() as $cat) {            
//                        echo
//   
//                        '<option '
//                        . ($linha['idconvidado'] == $cat['idconvidado'] ? " selected " : "")
//                        . ' value="'
//                        . $cat['idconvidado']
//                        . '">'
//                        .  $cat['nome']        
//                        
//                        // . ($cat['nome'] == "" ? " Todos os convidados foram selecionados " : $cat['nome'])
//                        . '</option>';
//                        
//                        
//                        
//                       }
                    
      
                    ?>
                    
                </select>
            </div>
       
            

            <div class="form-group">
                <button type="submit" name="salvar" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok"></span>
                    Salvar
                </button>
            </div>
        </form>
        
        
        
        
        
        
        
        
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
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