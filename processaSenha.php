<?php
require "conexao.php";
$sql = "select nome, email, senha, ativo from usuarios where email = '$_POST[email]'";
require "executaQuery.php";
if(mysqli_num_rows($result)>0){
    $usuario = mysqli_fetch_array($result);
    $nome = $usuario["nome"];
    $email = $usuario["email"];
    $senha = $usuario["senha"];
    $novaSenha = md5($_POST["esqueceuSenha"]);
    $ativo = $usuario["ativo"];
    $token = $_POST["token"];
    if(!$ativo){
        $erro = "Sua conta ainda não foi ativada! Verifique seu e-mail.";
        $assuntoEmail = ucfirst(explode(' ',trim($nome))[0]).", ative sua conta no CT Puzzle Test";
        $textoEmail="<h3>Olá ".ucfirst(explode(' ',trim($nome))[0])."!</h3><p>Recebemos seu cadastro no CT Puzzle Test. Clique <a href='http://lite.acad.univali.br/ctpuzzle/ativar.php?email=$_POST[cadastroEmail]&token=$tokenAtivarConta'>aqui</a> para ativar sua conta.</p><h4>CT Puzzle Test Team</h4><span>Observação: se você não solicitou o cadastro no nosso site, por favor desconsidere essa mensagem.</span>";
        $destinoEmail = $_POST['cadastroEmail'];
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
$sql = "UPDATE usuarios SET senha = '$novaSenha' WHERE email = '$email'";

require "executaQuery.php";
$erro = "Senha alterada com sucesso! Você já pode efetuar login na página inicial.";
file_put_contents("log.txt",$sql);
require "modalErro.php";
mysqli_close($conexao);
?>