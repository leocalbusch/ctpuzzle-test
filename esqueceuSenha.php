<?php
require "conexao.php";
$destinoEmail = $_POST['esqueceuEmail'];
$sql = "SELECT nome, email, senha, ativo, tipoUsuario FROM usuarios WHERE email='$destinoEmail'";
require "executaQuery.php";
if(mysqli_num_rows($result)>0){
    $usuario = mysqli_fetch_array($result);
    $email = $usuario["email"];
    $nome = $usuario["nome"];
    $senha = $usuario["senha"];
    $ativo = $usuario["ativo"];
    $tipoUsuario = $usuario["tipoUsuario"];
    $token = md5($email.$senha);
    if(!$ativo) {
        $assuntoEmail = ucfirst(explode(' ', trim($nome))[0]) . ", ative sua conta no CT Puzzle Test";
        $textoEmail = "<h3>Olá " . ucfirst(explode(' ', trim($nome))[0]) . "!</h3><p>Recebemos seu cadastro no CT Puzzle Test. Clique <a href='http://lite.acad.univali.br/ctpuzzle/ativar.php?email=$email&token=$token'>aqui</a> para ativar sua conta.</p><h4>CT Puzzle Test Team</h4><span>Observação: se você não solicitou o cadastro no nosso site, por favor desconsidere essa mensagem.</span>";
        $destinoEmail = $email;
        if($tipoUsuario==3)require "enviaEmail.php";
        $erro = $tipoUsuario==3?"Sua conta ainda não foi ativada! Verifique seu e-mail em $email.":"A eligibilidade da sua conta de aplicador está pendente de análise pela equipe do CT Puzzle Test. Em caso de dúvidas, entre em contato com nossa equipe.";
        require "modalErro.php";
        mysqli_close($conexao);
        exit();
    }
    $assuntoEmail = ucfirst(explode(' ',trim($nome))[0]).", altere sua senha no CT Puzzle Test";
    $textoEmail="<h3>Olá ".ucfirst(explode(' ',trim($nome))[0])."!</h3><p>Recebemos seu pedido de alteração de senha no CT Puzzle Test. Clique <a href='http://lite.acad.univali.br/ctpuzzle/alteraSenha.php?email=$email&token=$token'>aqui</a> para alterar sua senha.</p><h4>CT Puzzle Test Team</h4><span>Observação: se você não solicitou essa alteração no nosso site, por favor desconsidere essa mensagem.</span>";
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