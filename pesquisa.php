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
            <form action='processaPesquisa.php' method='post' >
            <?php
            if ($_SESSION["tipoUsuario"] == 3) { ?>
                <div class="card d-flex flex-row canvaBoy">
                    <img src="img/Instrucoes/guias/boy0000.png" class="w-25 h-25" alt="">
                    <div class="card-body" style="background:url(img/Instrucoes/guias/chat_bubble_left.png) no-repeat; background-size:100% 100%;">
                        <p class="card-text pl-5"><strong>Olá <?php echo $_SESSION[nome]; ?>!</strong> Gostaríamos de saber como foi sua experiência com o CT Puzzle Test! São só três perguntinhas. <strong>Vamos lá? </strong></p>
                    </div>
                </div>
                <br/>
                <div class='form-group'>
                    <label for='usabilidade'>Você teve alguma dificuldade com os controles do teste? Algum problema na hora de mexer nos objetos, algo que te atrapalhou? Por favor, descreva o mais detalhadamente possível para nos ajudar a melhorar.</label>
                    <textarea class="form-control" id='usabilidade' name='usabilidade' rows="3" required></textarea>
                </div>
                <div class='form-group'>
                    <label for='tutoriais'>Os tutoriais do teste te ajudaram a entender o que fazer em cada desafio ou você ainda ficou com dúvida em algum item? Por favor, descreva o mais detalhadamente possível para nos ajudar a melhorar.</label>
                    <textarea class="form-control" id="tutoriais" name='tutoriais' rows="3" required></textarea>
                </div>
                <div class='form-group'>
                    <label for='geral'>Agora que já falamos dos controles e dos tutoriais, por favor, conte como foi pra você realizar esse teste de uma maneira geral. Foi fácil ou difícil? Foi chato ou divertido? Se esse teste fosse para te avaliar, você se sentiria mais a vontade com ele do que com um questionário de múltipla escolha? </label>
                    <textarea class="form-control" id='geral' name='geral' rows="3" required></textarea>
                </div>
                <button type='submit' class='btn btn-primary'>Enviar Respostas</button>
                <?php
            }
            if ($_SESSION["tipoUsuario"] == 2) { ?>
            <p>Olá <?php echo $_SESSION[nome]; ?>! Por favor, utilize o menu superior para acessar as opções do site.</p>
            <?php
            } ?>
            </form>
        </div>

        <div class="col">
        </div>
    </div>
</div>

</body>
</html>