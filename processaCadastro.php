<?php
require "conexao.php";

$sql = "SELECT * FROM usuarios WHERE email = '$_POST[cadastroEmail]'";
require "executaQuery.php";

if (mysqli_num_rows($result) > 0) {
    $erro = "E-mail já cadastrado.";
    require "modalErro.php";
    mysqli_close($conexao);
    exit();
}

$sql = "INSERT INTO usuarios (nome, email, senha, dataNascimento, genero, tipoUsuario, ativo) VALUES (";
$sql .= "'" . $_POST['cadastroNome'] . "', ";
$sql .= "'" . $_POST['cadastroEmail'] . "', ";
$sql .= "'" . md5($_POST['cadastroSenha']) . "', ";
$sql .= "'" . $_POST['cadastroNascimento'] . "', ";
$sql .= $_POST['cadastroGenero'] . ", ";
$sql .= $_POST['tipo'] . ", ";
$sql .= 0;
$sql .= ")";

require "executaQuery.php";
$tokenAtivarConta = md5($_POST['cadastroEmail'] . md5($_POST['cadastroSenha']));
mysqli_close($conexao);
if ($_POST['tipo'] == 3) {
    $assuntoEmail = ucfirst(explode(' ', trim($_POST["cadastroNome"]))[0]) . ", ative seu cadastro no CT Puzzle Test";
    $textoEmail = "<h3>Olá " . ucfirst(explode(' ', trim($_POST["cadastroNome"]))[0]) . "!</h3><p>Recebemos seu cadastro no CT Puzzle Test. Clique <a href='http://lite.acad.univali.br/ctpuzzle/ativar.php?email=$_POST[cadastroEmail]&token=$tokenAtivarConta'>aqui</a> para ativar sua conta.</p><h4>CT Puzzle Test Team</h4><span>Observação: se você não solicitou o cadastro no nosso site, por favor desconsidere essa mensagem.</span>";
    $destinoEmail = $_POST['cadastroEmail'];
    require "enviaEmail.php";
} else {
    //E-mail para  aplicador
    $assuntoEmail = ucfirst(explode(' ', trim($_POST["cadastroNome"]))[0]) . ", recebemos seu pedido de cadastro no CT Puzzle Test";
    $textoEmail = "<h3>Olá " . ucfirst(explode(' ', trim($_POST["cadastroNome"]))[0]) . "!</h3><p>Recebemos seu cadastro no CT Puzzle Test. Nossa equipe precisa confirmar sua elegibilidade como aplicador do teste. Assim que validarmos suas informações, você receberá um novo e-mail informando a liberação do seu acesso.</p><h4>CT Puzzle Test Team</h4><span>Observação: se você não solicitou o cadastro no nosso site, por favor desconsidere essa mensagem.</span>";
    $destinoEmail = $_POST['cadastroEmail'];
    require "enviaEmail.php";
    //E-mail para o Adm (que precisa ativar a conta de aplicador)
    //obs.: um novo require "enviaEmail.php" dá erro, então pra enviar um segundo e-mail tive que setar as mudanças manualmente
    $assuntoEmail = "CT Puzzle Test - Ativar Novo Aplicador - $_POST[cadastroNome]";
    $textoEmail = "<h3>$_POST[cadastroNome]</h3><p>$_POST[cadastroEmail] - <a href='http://lite.acad.univali.br/ctpuzzle/ativar.php?email=$_POST[cadastroEmail]&token=$tokenAtivarConta'>Ativar</a></p><h4>CT Puzzle Test Team</h4>";
    $destinoEmail = "leonardocalbusch@gmail.com"; //e-mail do Adm
    $mail->Subject = $assuntoEmail;
    $mail->Body = $textoEmail;
    $mail->clearAllRecipients();
    $mail->AddAddress($destinoEmail);
    if (!$mail->Send()) {
        $erro = "Ocorreu um erro no envio do e-mail. " . $mail->ErrorInfo;
        require "modalErro.php";
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
</head>
<body onload="$('#exampleModal').modal('show')">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0" method="post" action="processaLogin.php">
                    <input class="form-control mr-sm-2 form-control-sm" type="email" placeholder="e-mail"
                           aria-label="e-mail" required name="loginEmail">
                    <input class="form-control mr-sm-2 form-control-sm" type="password" placeholder="senha"
                           aria-label="senha" required name="loginSenha">
                    <button class="btn px-0 nav-link" type="submit"><i class="fa fa-sign-in mr-sm-1"></i>Entrar</button>
                    <span class="nav-link disabled pr-0">/</span>
                    <button class="btn nav-link" type="button" data-toggle="modal" data-target="#exampleModal"><i
                                class="fa fa-user-plus mr-sm-1"></i>Cadastrar-se
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CT Puzzle Test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="window.location='index.php';">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Obrigado por se cadastrar no CT Puzzle Test! Antes de poder acessar o ambiente do teste, por favor
                    verifique o e-mail que acabamos de enviar para o endereço que você informou. Pode levar alguns
                    minutos até o e-mail chegar. Não esqueça de verificar sua pasta de "Spam" ou "Lixo Eletrônico". Se
                    você usa o Gmail, não esqueça também de verificar a aba "Promoções".</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="window.location='index.php';">Entendi
                </button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
        </div>
        <div class="col">

        </div>
        <div class="col">
        </div>
    </div>
</div>

</body>
</html>
