<?php
require_once './autentica.php';
require_once 'DAO/Mesa.php';
//require_once 'DAO/Categorias.php';

$montagem = new Mesa();
//$categorias = new Categorias();

$acao = $_GET["acao"] ?? "";
if ($acao == 'incluir' && isset($_POST['salvar'])) {
    $mesanumero = $_POST['mesanumero'];
    $numerodelugares = $_POST['numerodelugares'];
    $descricao = $_POST['descricao'];
    echo $mesanumero.$numerodelugares.$descricao;
    
    if ($montagem->insert($mesanumero, $numerodelugares, $descricao)) {
        header('Location: Tabela_mesas.php');
        exit();
    }
}

if ($acao == 'editar' && isset($_POST['salvar'])) {
    $mesanumero = $_POST['mesanumero'];
    $numerodelugares = $_POST['numerodelugares'];
    $descricao = $_POST['descricao'];
    echo $mesanumero.$numerodelugares.$descricao;
    if ($montagem->update($_GET['cod'], $_POST['mesanumero'], $_POST['numerodelugares'], $_POST['descricao'])) {
        header('Location: Tabela_mesas.php');
        exit();
    }
}

if ($acao == 'editar' && isset($_GET['cod'])) {
    $linha = $montagem->findByCod($_GET['cod']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mesa</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container">
        
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Convidados&Mesas</a>
            </div>
            <ul class="nav navbar-nav">
                <!--<li class="active"><a href="index.php">Home</a></li>-->
              <!--<li><a href="Tabela_convidado.php">Convidados</a></li>-->
              <li><a href="Tabela_mesas.php">Voltar para a Listagem de Mesas</a></li>
              <!--<li><a href="Tabela_montagem.php">Montagem de mesas</a></li>-->
            </ul>
              <ul class="nav navbar-nav navbar-right">
                    <?php
                   // session_start();
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
            <?php echo ($acao == "incluir" ? "Nova Mesa" : "Alterar Mesa") ?>
        </h3>
        <form method="post" class="form-horizontal">
            
            
            <div class="form-group">
                <label class="control-label">
                    Número da mesa 
                </label>
                <input type="number" 
                       class="form-control" 
                       name="mesanumero" 
                       required="" 
                       value="<?php if (isset($linha)) echo $linha['mesanumero'] ?>">
            </div>
            
            
            <div class="form-group">
                <label class="control-label">
                    Número de lugares
                </label>
                <input type="number" 
                       class="form-control"
                       name="numerodelugares"
                       required=""
                       
                       value="<?php if (isset($linha)) echo $linha['numerodelugares'] ?>">
            </div>
            
            
            
            <div class="form-group">
                <label class="control-label">
                    Descrição
                </label>
                <input type="text" 
                       class="form-control"
                       name="descricao"
                       required=""
                       
                       value="<?php if (isset($linha)) echo $linha['descricao'] ?>">
            </div>
            
            
            
            
            
<!--            <div class="form-group">
                <label class="control-label">
                    Categoria
                </label>
                <select name="codcategoria" required="" class="form-control">
                    <option value="">Selecione a categoria</option>
                    <?php
                    //foreach ($categorias->findAll() as $cat) {
                    //    echo '<option '
                    //    . ($linha['codcategoria'] == $cat['codcategoria'] ? " selected " : "")
                    //    . ' value="'
                    //    . $cat['codcategoria']
                    //    . '">'
                    //    . $cat['nome']
                    //    . '</option>';
                    //   }
                    ?>
                    
                </select>
            </div>-->
            
            
            

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
    </body>
</html>