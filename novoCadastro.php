<?php
session_start();
$_SESSION=array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Title</title>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#formCadastro").on('input', function () {
                $("#cadastroSenha")[0].setCustomValidity($("#cadastroSenha")[0].value.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/g) ? "" : "Sua senha precisa conter no mínimo 8 caracteres, e deve ser formada por letra minúsculas, letras maiúsculas e números.");
                $("#cadastroConfirmacao")[0].setCustomValidity(!$("#cadastroConfirmacao")[0].value.localeCompare($("#cadastroSenha")[0].value) ? "" : "A confirmação de senha não confere.");
                $("#cadastroEmail")[0].setCustomValidity($("#cadastroEmail")[0].value.match(/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i)?"":"Formato inválido! Verifique o e-mail informado.");
            });


        });
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <?php
                $msg[2] = "Agradecemos seu interesse em aplicar o CT Puzzle Test! Para se cadastrar como aplicador, é necessário que nossa equipe valide sua elegibilidade. Preencha seus dados e aguarde um e-mail de confirmação da liberação do seu acesso.";
                $msg[3] = "Olá estudante! Preencha seus dados";
                echo "<p>".$msg[$_GET[tipo]]."</p>";
            ?>
        </div>
        <div class="col">
            <form id="formCadastro" action="processaCadastro.php" method="post" >
                <div class="form-group">
                    <label for="cadastroNome">Seu nome completo</label>
                    <input type="text" class="form-control" id="cadastroNome" name="cadastroNome" required>
                </div>
                <div class="form-group">
                    <label for="cadastroEmail">Seu e-mail</label>
                    <input type="email" class="form-control" id="cadastroEmail" name="cadastroEmail" aria-describedby="emailHelp" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="cadastroSenha">Senha</label>
                    <input type="password" class="form-control" id="cadastroSenha" name="cadastroSenha"
                           title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                </div>
                <div class="form-group">
                    <label for="cadastroConfirmacao">Confirmação de senha</label>
                    <input type="password" class="form-control" id="cadastroConfirmacao" name="cadastroConfirmacao" required>
                </div>
                <div class="form-group">
                    <label for="cadastroNascimento">Data de nascimento</label>
                    <input type="date" class="form-control" id="cadastroNascimento" name="cadastroNascimento" required>
                </div>
                <div class="form-group">
                    <label for="cadastroGenero">Gênero</label>
                    <select class="form-control" id="cadastroGenero" name="cadastroGenero" required>
                        <option value="">&ltSelecione&gt</option>
                        <option value="0">Feminino</option>
                        <option value="1">Masculino</option>
                        <option value="2">Não-binário</option>
                    </select>
                </div>
                <input type="hidden" name="tipo" value="<?php echo $_GET["tipo"]; ?>"/>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
        <div class="col">
        </div>
    </div>
</div>

</body>
</html>