<?php
require "sessao.php";
require "conexao.php";
if(isset($_POST["idAmostra"])){
    $sql = "SELECT *, DATE_FORMAT(dataAplicacao, '%Y-%m-%d') as dataAmostra FROM amostras WHERE idAmostra=".$_POST["idAmostra"]." AND idAplicador = ".$_SESSION["idUsuario"];
    require "executaQuery.php";
    if(mysqli_num_rows($result)>0){
        $return = mysqli_fetch_assoc($result);
        // encoding array to json format
        echo json_encode($return);
        exit;
    }
}