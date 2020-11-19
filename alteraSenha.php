<?php
require "conexao.php";
$sql = "select nome, email, senha, ativo, tipoUsuario from usuarios where email = '$_GET[email]'";
require "executaQuery.php";
if(mysqli_num_rows($result)>0){
    $usuario = mysqli_fetch_array($result);
    $nome = $usuario["nome"];
    $email = $usuario["email"];
    $senha = $usuario["senha"];
    $ativo = $usuario["ativo"];
    $token = $_GET["token"];
    if(!$ativo){
        $erro = "Sua conta ainda não foi ativada! Verifique seu e-mail em $email.";
        $assuntoEmail = ucfirst(explode(' ',trim($nome))[0]).", ative sua conta no CT Puzzle Test";
        $textoEmail="<h3>Olá ".ucfirst(explode(' ',trim($nome))[0])."!</h3><p>Recebemos seu cadastro no CT Puzzle Test. Clique <a href='http://lite.acad.univali.br/ctpuzzle/ativar.php?email=$email&token=$token'>aqui</a> para ativar sua conta.</p><h4>CT Puzzle Test Team</h4><span>Observação: se você não solicitou o cadastro no nosso site, por favor desconsidere essa mensagem.</span>";
        $destinoEmail = $email;
        require "enviaEmail.php";
        require "modalErro.php";
        mysqli_close($conexao);
        exit();
    }elseif(md5($email.$senha)!=$token){
        $erro = "A chave de ativação da conta está incorreta ou expirou. Pode ser necessário se cadastrar novamente. Em caso de dúvidas, entre em contato com a equipe do CT Puzzle Test.";
        require "modalErro.php";
        mysqli_close($conexao);
        exit();
    }
}else{
    $erro = "Você não tem permissão para acessar essa página. Em caso de dúvidas, entre em contato com a equipe do CT Puzzle Test.";
    require "modalErro.php";
    mysqli_close($conexao);
    exit();
}
mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CT Puzzle Test</title>
    <script>
        $(document).ready(function () {
            $("#modalLogin").modal("show");
            $("#logout").click(function (e) {
                window.location.href = "index.php";
            });
            $("#logoutx").click(function (e) {
                window.location.href = "index.php";
            });
            $("#formSenha").on('input', function () {
                $("#esqueceuSenha")[0].setCustomValidity($("#esqueceuSenha")[0].value.match(/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/g) ? "" : "Sua senha precisa conter no mínimo 8 caracteres, e deve ser formada por letra minúsculas, letras maiúsculas e números.");
                $("#esqueceuConfirmacao")[0].setCustomValidity(!$("#esqueceuConfirmacao")[0].value.localeCompare($("#esqueceuSenha")[0].value) ? "" : "A confirmação de senha não confere.");
            });
        });

    </script>
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CT Puzzle Test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Preencha os campos abaixo para alterar sua senha do CT Puzzle Test</p>
                <form id="formSenha" method="post" action="processaSenha.php">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="esqueceuSenha">Nova senha</label>
                            <input type="password" class="form-control" id="esqueceuSenha" name="esqueceuSenha"
                                   title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="esqueceuConfirmacao">Confirmação de senha</label>
                            <input type="password" class="form-control" id="esqueceuConfirmacao" name="esqueceuConfirmacao" required>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                    <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                    <input type="hidden" name="token" value="<?php echo $token; ?>"/>
                    <button type="submit" class="btn btn-primary">Alterar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
