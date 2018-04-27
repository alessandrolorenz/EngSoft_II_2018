<?php
if (isset($_POST["cadastrar"])) {
    if ($_POST["senha"] == $_POST["repsenha"]) {
        require_once 'DAO/Usuarios.php';
        $usuarios = new Usuarios();

        if ($usuarios->insert($_POST["login"], $_POST["email"], $_POST["senha"])) {
            header("Location: index.php");
            exit();
        } else {
            $msg = "Não inseriu o usuário";
        }
    } else {
        $msg = "As senhas não conferem";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastro</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container" style="padding-top: 30px">
        <div class="panel panel-default">
            <div class="panel-heading">Cadastro de usuário</div>
            <div class="panel-body">
                <form  method="post">
                    <div class="form-group">
                        <label>Usuário </label>
                        <input type="text" class="form-control" name="login" required="" autofocus="">
                    </div>
                    <div class="form-group">
                        <label>email</label>
                        <input type="email" class="form-control" name="email" required="">
                    </div>
                    
                    
                    <div class="form-group">
                        <label>Senha </label>
                        <input type="password" name="senha" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Repita a Senha</label>
                        <input type="password" name="repsenha" class="form-control" required="">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary btn-block">
                    </div>
                </form>       
            </div>
        </div>
        <?php
        if (isset($msg)) {
            echo '<div class="alert alert-danger">'
            . $msg
            . '</div>';
        }
        ?>        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>