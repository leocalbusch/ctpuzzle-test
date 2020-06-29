<?php
session_start();
// comentei pra testar enquanto não tenho banco. Mas já deve ser reativado
if(!isset($_SESSION["idUsuario"])) {
    $erro = "Ocorreu um erro ao acessar os dados de sessão desta página. Por favor, realize login novamente.";
    require "modalErro.php";
    exit();
}

