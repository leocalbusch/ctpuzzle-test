<?php
require "sessao.php";
require "conexao.php";

$sql="SELECT * FROM amostras WHERE chave = '".$_POST["chaveAmostra"]."' AND aberta = 1";
require "executaQuery.php";

if(mysqli_num_rows($result)==0){
    $chave = false;
    $msg = "Chave inválida ou teste não liberado. Favor contatar o responsável.";
}else {
    $amostra = mysqli_fetch_array($result);
    $_SESSION["idAmostra"]=$amostra["idAmostra"];
    $sql = "select r.idEstudante, ar.* from resultados r, amostras_resultados ar where ar.idResultado = r.idResultado AND r.idEstudante = " . $_SESSION["idUsuario"]. " AND ar.idAmostra=" . $amostra["idAmostra"];
    require "executaQuery.php";
    if (mysqli_num_rows($result)) {
        $chave = true;
        $resultados = mysqli_fetch_array($result);
        $_SESSION["idResultado"]=$resultados["idResultado"];
        $msg =  "Você já iniciou o teste uma vez. Se iniciar novamente, perderá os resultados anteriores. Tem certeza que deseja reiniciar o teste?";
    } else {
        $chave = true;
        $_SESSION["idResultado"]=0;
        $msg = "Tudo pronto. Vamos iniciar o teste?";
    }
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
<?php require "navBar.php"; ?>
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
                <?php if ($chave) echo "<button type='button' class='btn btn-success' id='iniciarTeste' >Vamos lá!</button>"; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
