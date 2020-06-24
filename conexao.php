<?php
$conexao = mysqli_connect('nspro16.hostgator.com.br', 'calbus59_se6ry68', '!$Gd2*7AP&aP', 'calbus59_ctpuzzle_old');

if (!$conexao) {
    $erro = "Ocorreu um erro na conexão com o banco de dados. Por favor, realize login novamente.";
    require "modalErro.php";
    mysqli_close($conexao);
    exit();
}