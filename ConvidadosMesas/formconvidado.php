<?php
require_once './autentica.php';
require_once 'DAO/Convidado.php';
//require_once 'DAO/Categorias.php';

$convidados = new Convidado();
//$categorias = new Categorias();

$acao = $_GET["acao"] ?? "";
if ($acao == 'incluir' && isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $ladofamilia = $_POST['ladofamilia'];
    $status = $_POST['status'];
    if ($convidados->insert($nome, $email, $telefone, $ladofamilia, $status)) {
        header('Location: Tabela_convidado.php');
        exit();
    }
}

if ($acao == 'editar' && isset($_POST['salvar'])) {
    if ($convidados->update($_GET['cod'], $_POST['nome'], $_POST['email'], $_POST['telefone'], $_POST['ladofamilia'], $_POST['status'])) {
        header('Location: Tabela_convidado.php');
        exit();
    }
}

if ($acao == 'editar' && isset($_GET['cod'])) {
    $linha = $convidados->findByCod($_GET['cod']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Convidado</title>

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
              <li><a href="Tabela_convidado.php">Voltar para a Listagem de Convidados</a></li>
              <!--<li><a href="Tabela_mesas.php">Mesas</a></li>-->
              <!--<li><a href="Tabela_montagem.php">Montagem de mesas</a></li>-->
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
            <?php echo ($acao == "incluir" ? "Novo convidado" : "Alterar convidado") ?>
        </h3>
        <form method="post" class="form-horizontal">
            <div class="form-group">
                <label class="control-label">
                    Nome: 
                </label>
                <input type="text" 
                       class="form-control" 
                       name="nome" 
                       required="" 
                       value="<?php if (isset($linha)) echo $linha['nome'] ?>">
            </div>
            <div class="form-group">
                <label class="control-label">
                    email
                </label>
                <input type="email" 
                       class="form-control"
                       name="email"
                       required=""
                       
                       value="<?php if (isset($linha)) echo $linha['email'] ?>">
            </div>
            <div class="form-group">
                <label class="control-label">
                    Telefone
                </label>
                <input type="text"
                       class="form-control"
                       name="telefone"
                       
                       value="<?php if (isset($linha)) echo $linha['telefone'] ?>">
            </div>
            
            
            <div class="form-group">
                <label class="control-label">
                    Família
                </label>
                <input type="text"
                       class="form-control"
                       name="ladofamilia"
                       
                       value="<?php if (isset($linha)) echo $linha['ladofamilia'] ?>">
            </div>
            
            <div class="form-group">
                <label class="control-label">
                    Status
                </label>
                <input type="number"
                       class="form-control"
                       name="status"
                       
                       value="<?php if (isset($linha)) echo $linha['status'] ?>">
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