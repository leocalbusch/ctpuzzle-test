<?php

    require "sessao.php";
    require "conexao.php";
    foreach ($_POST["amostras"] as $amostra) {
        $abertas .= $amostra . ",";
    }
    $abertas = substr($abertas, 0, -1);

// atualiza as abertas
    $sql = "UPDATE amostras SET aberta = 1 WHERE idAplicador = $_SESSION[idUsuario]";
    if (isset($_POST["amostras"])) $sql .= " AND idAmostra IN ($abertas)";
    require "executaQuery.php";

//atualiza as fechadas (que não vieram via post)
    $sql = "UPDATE amostras SET aberta = 0 WHERE idAplicador = $_SESSION[idUsuario]";
    if (isset($_POST["amostras"])) $sql .= " AND idAmostra NOT IN ($abertas)";
    require "executaQuery.php";

    mysqli_close($conexao);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CT Puzzle Test</title>
    <script>
        $(document).ready(function () {
            $("#exampleModal").modal("show");
            $("#exampleModal").on("hide.bs.modal", function (e) {
                window.location.href = "dashboard.php";
            });
        });

    </script>
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CT Puzzle Test</h5>
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Alterações efetuadas com sucesso!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Entendi</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
