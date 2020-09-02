<?php
session_start();
require "conexao.php";

$sql="SELECT * FROM usuarios WHERE email = '".$_POST["loginEmail"]."' AND senha='". md5($_POST["loginSenha"]) . "'" ;
require "executaQuery.php";
if(mysqli_num_rows($result)>0) {
    $usuario = mysqli_fetch_array($result);
    if ($usuario["ativo"]) {
        $_SESSION["idUsuario"] = $usuario["idUsuario"];
        $_SESSION["tipoUsuario"] = $usuario["tipoUsuario"];
        $_SESSION["nome"] = $usuario["nome"];
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'dashboard.php';
        header("Location: $extra");
    } else {
        $erro = "Acesso não liberado. Aguarde a verificação de eligibilidade da equipe CT Puzzle Test ou entre em contato por meio do endereço eletrônico contato@ctpuzzletest.com";
        require "modalErro.php";
    }
}else{
    $erro = "E-mail ou senha não confere. Verifique as informações preenchidas e tente novamente.";
    require "modalErro.php";
}
mysqli_close($conexao);
?>