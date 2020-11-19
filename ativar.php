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
    $tipoUsuario = $usuario["tipoUsuario"];
    if($ativo){
        $erro = "Sua conta já foi ativada! Efetue login na página inicial.";
        require "modalErro.php";
    }elseif(md5($email.$senha)!=$_GET["token"]){
        $erro = "A chave de ativação da conta está incorreta ou expirou. Pode ser necessário se cadastrar novamente. Em caso de dúvidas, entre em contato com a equipe do CT Puzzle Test.";
        require "modalErro.php";
    }else{
        $sql = "UPDATE usuarios SET ativo = 1 WHERE email = '$email'";
        require "executaQuery.php";
        mysqli_close($conexao);
        //E-mail confirmando ativação
        $assuntoEmail = ucfirst(explode(' ', trim($nome))[0]) . ", seu cadastro no CT Puzzle Test foi ativado!";
        $textoEmail = "<h3>Olá " . ucfirst(explode(' ', trim($nome))[0]) . "!</h3><p>Seu cadastro no CT Puzzle Test foi ativado com sucesso! Você já pode efetuar login <a href='http://lite.acad.univali.br/ctpuzzle'>aqui</a>. Obrigado por se cadastrar no CT Puzzle Test!</p><h4>CT Puzzle Test Team</h4><span>Observação: se você não solicitou o cadastro no nosso site, por favor desconsidere essa mensagem.</span>";
        $destinoEmail = $email;
        require "enviaEmail.php";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CT Puzzle Test</title>
</head>
<body onload="$('#exampleModal').modal('show')">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">CT Puzzle Test</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0" method="post" action="processaLogin.php">
                    <input class="form-control mr-sm-2 form-control-sm" type="email" placeholder="e-mail" aria-label="e-mail" required name="loginEmail">
                    <input class="form-control mr-sm-2 form-control-sm" type="password" placeholder="senha" aria-label="senha" required name="loginSenha">
                    <button class="btn px-0 nav-link" type="submit"><i class="fa fa-sign-in mr-sm-1"></i>Entrar</button>
                    <span class="nav-link disabled pr-0">/</span>
                    <button class="btn nav-link" type="button" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-user-plus mr-sm-1"></i>Cadastrar-se</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CT Puzzle Test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location='index.php';">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Conta ativada! Vá para a página inicial e efetue seu login.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location='index.php';">Entendi</button>
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

