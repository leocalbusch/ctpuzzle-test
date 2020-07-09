<?php
require "conexao.php";
$destinoEmail = $_POST['esqueceuEmail'];
$sql = "SELECT nome, email, senha, ativo FROM usuarios WHERE email='$destinoEmail'";
require "executaQuery.php";
if(mysqli_num_rows($result)>0){
    $usuario = mysqli_fetch_array($result);
    $email = $usuario["email"];
    $nome = $usuario["nome"];
    $senha = $usuario["senha"];
    $ativo = $usuario["ativo"];
    $token = md5($email.$senha);
    if(!$ativo) {
        $erro = "Sua conta ainda não foi ativada! Verifique seu e-mail em $email.";
        $assuntoEmail = ucfirst(explode(' ', trim($nome))[0]) . ", ative sua conta no CT Puzzle Test";
        $textoEmail = "<h3>Olá " . ucfirst(explode(' ', trim($nome))[0]) . "!</h3><p>Recebemos seu cadastro no CT Puzzle Test. Clique <a href='http://calbusch.com.br/ctpuzzlehtml5/ativar.php?email=$email&token=$token'>aqui</a> para ativar sua conta.</p><h4>CT Puzzle Test Team</h4><span>Observação: se você não solicitou o cadastro no nosso site, por favor desconsidere essa mensagem.</span>";
        $destinoEmail = $email;
        require "enviaEmail.php";
        require "modalErro.php";
        mysqli_close($conexao);
        exit();
    }
    $assuntoEmail = ucfirst(explode(' ',trim($nome))[0]).", altere sua senha no CT Puzzle Test";
    $textoEmail="<h3>Olá ".ucfirst(explode(' ',trim($nome))[0])."!</h3><p>Recebemos seu pedido de alteração de senha no CT Puzzle Test. Clique <a href='http://calbusch.com.br/ctpuzzlehtml5/alteraSenha.php?email=$email&token=$token'>aqui</a> para alterar sua senha.</p><h4>CT Puzzle Test Team</h4><span>Observação: se você não solicitou essa alteração no nosso site, por favor desconsidere essa mensagem.</span>";
    require "enviaEmail.php";
    $erro = "Lhe enviamos um e-mail com instruções para alteração da sua senha." . $mail->ErrorInfo;
    require "modalErro.php";
    mysqli_close($conexao);
    exit();
}else{
    $erro = "O endereço de e-mail informado não está cadastrado." . $mail->ErrorInfo;
    require "modalErro.php";
    mysqli_close($conexao);
    exit();
}
mysqli_close($conexao);
?>