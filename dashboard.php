<?php
require "sessao.php";
require "conexao.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
    <script>
        $(document).ready(function(){
            // seta a data atual na data de criação da amostra
            var tzoffset = (new Date()).getTimezoneOffset() * 60000; //offset in milliseconds
            $('#cadastroData').val(new Date(Date.now() - tzoffset).toISOString().slice(0, 10));
            //seta a função popover para o help dos campos
            $('[data-toggle="popover"]').popover();
            //chama o modal de logout
            $("#logout").click(function(){
                window.location.href = "modalErro.php?logout=1";
            });
            //recarrega a página ao fechar o modal principal
            $('#minhasAmostras').on('hide.bs.modal', function (e) {
                window.location.href = "dashboard.php";
            });
            //quando clica em uma amostra, carrega e popula o formulário de edit
            $("#minhaAmostra tr td a").on("click",function(e){
                var idAmostra = $(this).attr('data-idamostra');
                // AJAX
                $.ajax({
                    url: 'buscaAmostra.php',
                    type: 'post',
                    data: {idAmostra: idAmostra},
                    dataType: 'json',
                    success: function (response) {

                        var len = Object.keys(response).length;
                        if (len > 0) {
                            // Set value to textboxes
                            document.getElementById('editaNome').value = response['nome'];
                            document.getElementById('editaDescricao').value = response['descricao'];
                            document.getElementById('editaData').value = response['dataAmostra'];
                            document.getElementById('editaChave').value = response['chave'];
                            document.getElementById('editaSerie').value = response['serie'];
                            document.getElementById('editaTurma').value = response['turma'];
                            document.getElementById('editaInstituicao').value = response['instituicao'];
                            document.getElementById('editaCidade').value = response['cidade'];
                            document.getElementById('editaEstado').value = response['estado'];
                            document.getElementById('editaPais').value = response['pais'];
                            document.getElementById('idAmostra').value = response['idAmostra'];
                        }

                    }
                });
            });
        });

    </script>
    <style type="text/css">
        .comic{
            font-family: "Comic Sans MS";
        }
        .canvaBoy{
            background: #dbf4d3;
        }
        .canvaGirl{
            background: lavenderblush;
        }
    </style>
    <title>CT Puzzle Test</title>
</head>
<body>
<?php require "navBar.php"; ?>

<!-- Modal Sair-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
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
                <button type="button" class="btn btn-danger" id="logout">Sim, quero sair</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Minhas Amostras -->
<?php require "minhasAmostras.php"; ?>

<!-- Form Iniciar Teste com Chave -->
<div class="container comic">
    <div class="row">
        <div class="col">
        </div>
        <div class="col-lg-6 col-sm-10">
            <?php
            if ($_SESSION["tipoUsuario"] == 3) { ?>
                <div class="card d-flex flex-row canvaBoy">
                    <img src="img/Instrucoes/guias/boy0000.png" class="w-25 h-25" alt="">
                    <div class="card-body" style="background:url(img/Instrucoes/guias/chat_bubble_left.png) no-repeat; background-size:100% 100%;">
                        <p class="card-text pl-5"><strong>Olá <?php echo $_SESSION[nome]; ?>!</strong> Bem-vindo(a) ao CT Puzzle Test, um teste sobre Pensamento Computacional! Antes de começar, temos algumas instruções importantes pra você. <strong>Preste bastante atenção!</strong></p>
                    </div>
                </div>
                <div class="card d-flex flex-row canvaGirl">
                    <div class="card-body" style="background:url(img/Instrucoes/guias/chat_bubble_right.png) no-repeat; background-size:100% 100%;">
                        <p class="card-text pr-5">O objetivo é chegar ao final sem se preocupar com uma pontuação. Você vai encontrar vários tipos de desafios. Para resolvê-los, você vai precisar clicar em objetos, arrastar figuras pela tela, girar e trocar coisas de lugar.</p>
                    </div>
                    <img src="img/Instrucoes/guias/girl0000.png" class="w-25 h-25" alt="">
                </div>
                <div class="card d-flex flex-row canvaBoy">
                    <img src="img/Instrucoes/guias/boy0000.png" class="w-25 h-25" alt="">
                    <div class="card-body" style="background:url(img/Instrucoes/guias/chat_bubble_left.png) no-repeat; background-size:100% 100%;">
                        <p class="card-text pl-5">Para se dar bem no teste, tente resolvê-lo no menor tempo possível. Além disso, tente sempre encontrar a melhor solução para cada desafio.</p>
                    </div>
                </div>
                <div class="card d-flex flex-row canvaGirl">
                    <div class="card-body" style="background:url(img/Instrucoes/guias/chat_bubble_right.png) no-repeat; background-size:100% 100%;">
                        <p class="card-text pr-5">Procure usar a menor quantidade de recursos possível, tentando dar menos cliques na tela, menos giros nos objetos, menos comandos nos programas. Você pode pular se estiver muito difícil, mas não desista! Mostre que você consegue!</p>
                    </div>
                    <img src="img/Instrucoes/guias/girl0000.png" class="w-25 h-25" alt="">
                </div>
                <div class="card d-flex flex-row canvaBoy">
                    <img src="img/Instrucoes/guias/boy0000.png" class="w-25 h-25" alt="">
                    <div class="card-body" style="background:url(img/Instrucoes/guias/chat_bubble_left.png) no-repeat; background-size:100% 100%;">
                        <p class="card-text pl-5">Algumas fases possuem dicas que te mostram o próximo passo para resolver o desafio. Tente resolver sem usar dicas, mas se não conseguir avançar, elas estão ali pra te ajudar.</p>
                    </div>
                </div>
                <div class="card d-flex flex-row canvaGirl">
                    <div class="card-body" style="background:url(img/Instrucoes/guias/chat_bubble_right.png) no-repeat; background-size:100% 100%;">
                        <p class="card-text pr-5">Para iniciar seu teste, você precisa informar aqui na caixinha a sua chave de acesso! Ainda não possui uma ou não sabe do que eu estou falando? Pergunta pra pessoa responsável pela aplicacão do teste, provavelmente seu professor! Vamos lá?</p>
                    </div>
                    <img src="img/Instrucoes/guias/girl0000.png" class="w-25 h-25" alt="">
                </div>
                <div class="card d-flex flex-row">
                    <img src="img/Instrucoes/guias/boy0000.png" class="w-25 h-25 mt-auto" alt="">
                    <div class="card-body">
                        <form action='processaVinculaAmostra.php' method='post' >
                            <div class='form-group'>
                                <label for='chaveAmostra'>Chave de acesso:</label>
                                <input type='text' class='form-control' id='chaveAmostra' name='chaveAmostra'><br/>
                                <button type='submit' class='btn btn-primary'>Iniciar</button>
                            </div>
                        </form>
                    </div>
                    <img src="img/Instrucoes/guias/girl0000.png" class="w-25 h-25 mt-auto" alt="">
                </div>
                <?php
            }
            if ($_SESSION["tipoUsuario"] == 2) { ?>
            <p>Olá <?php echo $_SESSION[nome]; ?>! Por favor, utilize o menu superior para acessar as opções do site.</p>
            <?php
            } ?>
        </div>

        <div class="col">
        </div>
    </div>
</div>

</body>
</html>