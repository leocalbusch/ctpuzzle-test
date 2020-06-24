<?php
$result = mysqli_query($conexao,$sql);
if (mysqli_errno($conexao) > 0) {
    $erro["query"] = "Ocorreu um erro interno no bando de dados. Por favor, realize login novamente.";
    require "modalErro.php";
    mysqli_close($conexao);
    exit();
}