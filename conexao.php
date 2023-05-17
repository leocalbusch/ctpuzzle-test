
<?php
$conexao = mysqli_connect('lite.acad.univali.br', 'leo', '2#KTFA2Nz@SzrTxv', 'ct_puzzle', '443');
if (!$conexao) {
    $erro = "Ocorreu um erro na conexão com o banco de dados. Por favor, realize login novamente.";
    require "modalErro.php";
    mysqli_close($conexao);
    exit();
}