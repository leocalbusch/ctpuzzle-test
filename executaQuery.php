<?php
$result = mysqli_query($conexao,$sql);
if (mysqli_errno($conexao) > 0) {
    $erro = "Ocorreu um erro interno no bando de dados. Por favor, realize login novamente. <br />Erro: ". mysqli_error($conexao);
    file_put_contents("log.txt", $erro);
    require "modalErro.php";
    mysqli_close($conexao);
    exit();
}