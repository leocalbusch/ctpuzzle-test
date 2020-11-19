<?php
require "sessao.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script>
        $(document).ready(function(){
            $("#logout").click(function(){
                window.location.href = "modalErro.php?logout=1";
            });
        });

    </script>
    <title>CT Puzzle Test</title>
    <script src="js/utils.js"></script>
    <script src="js/Matriz.js"></script>
    <script src="js/Imagem.js"></script>
    <script src="js/Programacao.js"></script>
    <script src="js/Match.js"></script>
    <script src="js/Pontos.js"></script>
    <script src="js/Tangram.js"></script>
    <script src="js/Escore.js"></script>
    <script src="js/Sequencia.js"></script>
    <script src="js/Classifica.js"></script>
    <script src="js/ObjClassifica.js"></script>
    <script src="js/PersonagemProg.js"></script>
    <script src="js/TelaEscolha.js"></script>
    <script src="js/TelaNome.js"></script>
    <script src="js/InstrucoesPassoAPasso.js"></script>
    <script src="js/Instrucoes.js"></script>
    <script src="js/main.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
    <link rel="stylesheet" href="css/style.css"/>
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
                <p>Tem certeza que deseja sair?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="logout">Sim, quero sair</button>
            </div>
        </div>
    </div>
</div>

<canvas id="gameCanvas" width="800" height="600">
    <script>
        begin();
    </script>
</canvas>
<br>
<br>
<?php

/*$conexao = mysqli_connect('nspro16.hostgator.com.br', 'calbus59_se6ry68', '!$Gd2*7AP&aP', 'calbus59_ctpuzzle_old');
if (mysqli_connect_errno($conexao) > 0) {
    echo("Erro de conexão: " . mysqli_connect_error());
    die();
}
$sqlResultado = mysqli_query($conexao, "CREATE TABLE resultadosNovos(id SERIAL PRIMARY KEY, dataHora VARCHAR(200) NOT NULL, aluno VARCHAR(200) NOT NULL, pontosGeral0 INT, pontosDica0 INT, pontosClicks0 INT, pontosTempo0 INT, pontosLimpar0 INT, pontosPulou0 INT, pontosGeral1 INT,pontosDica1 INT, pontosClicks1 INT, pontosTempo1 INT, pontosLimpar1 INT, pontosPulou1 INT, pontosGeral2 INT, pontosDica2 INT, pontosClicks2 INT, pontosTempo2 INT, pontosLimpar2 INT, pontosPulou2 INT, pontosGeral3 INT, pontosDica4 INT, pontosClicks4 INT, pontosTempo4 INT, pontosLimpar4 INT, pontosPulou4 INT, matchGeral0 INT, matchDica0 INT, matchClicks0 INT, matchTempo0 INT, matchGiros0 INT, matchPulou0 INT, matchGeral1 INT, matchDica1 INT, matchClicks1 INT, matchTempo1 INT, matchGiros1 INT, matchPulou1 INT, tangramGeral0 INT, tangramDica0 INT, tangramClicks0 INT, tangramTempo0 INT, tangramGiros0 INT, tangramPulo0 INT, tangramGeral1 INT, tangramDica1 INT, tangramClicks1 INT, tangramTempo1 INT, tangramGiros1 INT, tangramPulou1 INT, classificaGeral INT,classificaTempo INT, classificaDica INT, classificaTentativa INT, classificaLimpar INT, classificaPulou INT, sequenciaGeral0 INT, sequenciaTempo0 INT, sequenciaDica0 INT, sequenciaTentativa0 INT, sequenciaPulou0 INT, sequenciaGeral1 INT, sequenciaTempo1 INT, sequenciaDica1 INT, sequenciaTentativa1 INT, sequenciaPulou1 INT, progGeral0 INT, progTempo0 INT, progInstrucoes0 INT, progApagou0 INT, progApagouAll0 INT, progPlay0 INT, progPulou0 INT, progGeral1 INT, progTempo1 INT, progInstrucoes1 INT, progApagou1 INT, progApagouAll1 INT, progPlay1 INT, progPulou1 INT, progGeral2 INT, progTempo2 INT, progInstrucoes2 INT, progApagou2 INT, progApagouAll2 INT, progPlay2 INT, progPulou2 INT, progGeral3 INT, progTempo3 INT, progInstrucoes3 INT, progApagou3 INT, progApagouAll3 INT, progPlay3 INT, progPulou3 INT, progGeral4 INT, progTempo4 INT, progInstrucoes4 INT, progApagou4 INT, progApagouAll4 INT, progPlay4 INT, progPulou4 INT, progGeral5 INT, progTempo5 INT, progInstrucoes5 INT, progApagou5 INT, progApagouAll5 INT, progPlay5 INT, progPulou5 INT, progGeral6 INT, progTempo6 INT, progInstrucoes6 INT, progApagou6 INT, progApagouAll6 INT, progPlay6 INT, progPulou6 INT, progLoopGeral0 INT, progTempoLoop0 INT, progInstrucoesLoop0 INT, progApagouLoop0 INT, progApagouAllLoop0 INT, progPlayLoop0 INT, progLoopLoop0 INT, progInstrucoesLoopLoop0 INT, progPulouLoop0 INT, progLoopGeral1 INT, progTempoLoop1 INT, progInstrucoesLoop1 INT, progApagouLoop1 INT, progApagouAllLoop1 INT, progPlayLoop1 INT, progLoopLoop1 INT, progInstrucoesLoopLoop1 INT, progPulouLoop1 INT, abstracao INT, decomposicao INT, reconhecimento INT, programacao INT)");
if (mysqli_errno($conexao) > 0) {
    echo mysqli_error($conexao);
    die();
}
echo "tabela criada com sucesso";*/

?>
</body>
</html>