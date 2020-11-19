<?php
require "sessao.php";
require "conexao.php";


$sql="SELECT * FROM amostras WHERE chave = '".$_POST["cadastroChave"]."'";
if(isset($_POST["editar"])){
    $sql.=" AND idAmostra <> ".$_POST["idAmostra"];
}
require "executaQuery.php";

if(mysqli_num_rows($result)>0){
    $chave = false;
    $msg = "Chave inválida. Nenhuma alteração foi realizada";
}else {
    $chave=true;
    if(isset($_POST["editar"])){
        $sql = "UPDATE amostras SET ";
        $sql.= "nome = '$_POST[cadastroNome]',";
        $sql.= "descricao = '$_POST[cadastroDescricao]',";
        $sql.= "dataAplicacao = '$_POST[cadastroData]',";
        $sql.= "chave = '$_POST[cadastroChave]',";
        $sql.= "serie = '$_POST[cadastroSerie]',";
        $sql.= "turma = '$_POST[cadastroTurma]',";
        $sql.= "instituicao = '$_POST[cadastroInstituicao]',";
        $sql.= "cidade = '$_POST[cadastroCidade]',";
        $sql.= "estado = '$_POST[cadastroEstado]',";
        $sql.= "pais = '$_POST[cadastroPais]' ";
        $sql.= "WHERE idAmostra = ".$_POST["idAmostra"]." AND idAplicador=".$_SESSION["idUsuario"];
        $msg = "Informações atualizadas com sucesso!";
    }
    else {
        $sql = "INSERT INTO amostras (nome, descricao, dataAplicacao, aberta, chave, serie, turma, instituicao, cidade, estado, pais, idAplicador) VALUES ";
        $sql .= "('" . $_POST["cadastroNome"] . "'";
        $sql .= ",'" . $_POST["cadastroDescricao"] . "'";
        $sql .= ",'" . $_POST["cadastroData"] . "'";
        $sql .= ",0";
        $sql .= ",'" . $_POST["cadastroChave"] . "'";
        $sql .= ",'" . $_POST["cadastroSerie"] . "'";
        $sql .= ",'" . $_POST["cadastroTurma"] . "'";
        $sql .= ",'" . $_POST["cadastroInstituicao"] . "'";
        $sql .= ",'" . $_POST["cadastroCidade"] . "'";
        $sql .= ",'" . $_POST["cadastroEstado"] . "'";
        $sql .= ",'" . $_POST["cadastroPais"] . "'";
        $sql .= "," . $_SESSION["idUsuario"];
        $sql .= ")";
        $msg = "Amostra cadastrada com sucesso! Chave: $_POST[cadastroChave]";
    }
    require "executaQuery.php";
}
mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CT Puzzle Test</title>
    <script>
        $(document).ready(function(){
            $('#exampleModal').modal("show");
            $('#exampleModal').on('hide.bs.modal', function (e) {
                window.location.href = "dashboard.php";
            });
            $("#iniciarTeste").click(function(){
                window.location.href = "teste.php";
            });
        });

    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <span class="nav-link">Olá <?php echo $_SESSION["nome"]; ?>!</span>
            </li>
            <li class="nav-item">
                <button class="btn nav-link" type="button" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-sign-out mr-sm-1"></i>Sair</button>
            </li>
        </ul>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CT Puzzle Test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo $msg; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                <?php //if ($chave) echo "<button type='button' class='btn btn-success' id='iniciarTeste' >Vamos lá!</button>"; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
