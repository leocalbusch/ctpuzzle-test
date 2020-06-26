<?php
file_put_contents("teste.txt", "entrou");
require "sessao.php";
require "conexao.php";
file_put_contents("teste.txt", "passou dos require");
if(isset($_POST["idAmostra"])){
    $sql = "SELECT *, DATE_FORMAT(dataAplicacao, '%Y-%m-%d') as dataAmostra FROM amostras WHERE idAmostra=".$_POST["idAmostra"]." AND idAplicador = ".$_SESSION["idUsuario"];
    file_put_contents("teste.txt", $sql);
    require "executaQuery.php";
    if(mysqli_num_rows($result)>0){
        $return = mysqli_fetch_assoc($result);
        // encoding array to json format
        echo json_encode($return);
        exit;
    }
}