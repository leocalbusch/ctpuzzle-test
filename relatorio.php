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
    <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
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
    <title>CT Puzzle Test</title>
    <script>
        $(document).ready(function(){
            $("#logout").click(function(){
                window.location.href = "modalErro.php?logout=1";
            });
            $('#minhasAmostras').on('hide.bs.modal', function (e) {
                window.location.href = "dashboard.php";
            });
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
                        console.log(len);
                        if (len > 0) {
                            // Set value to textboxes
                            console.log(response);
                            document.getElementById('editaNome').value = response['nome'];
                            document.getElementById('editaDescricao').value = response['descricao'];
                            document.getElementById('editaData').value = response['dataAmostra'];
                            document.getElementById('editaChave').value = response['chave'];
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
<div class="container">
    <div class="row">
        <div class="col">
        </div>
        <div class="col-8">
            <table class="table table-sm table-hover mb-0" id="minhaAmostra">

                <?php
                $sql = "select usuarios.nome, usuarios.email, resultados.*, amostras.nome as nomeAmostra, date_format(amostras.dataAplicacao,'%d/%m/%Y') as dataAplicacao from resultados, amostras_resultados, usuarios, amostras WHERE resultados.idResultado = amostras_resultados.idResultado AND amostras.idAmostra = amostras_resultados.idAmostra AND amostras_resultados.idAmostra = $_GET[idAmostra] AND resultados.idEstudante = usuarios.idUsuario AND amostras.idAplicador = $_SESSION[idUsuario]";
                require "executaQuery.php";
                $cont = 0;
                if (mysqli_num_rows($result) > 0) {
                    while ($amostra = mysqli_fetch_array($result)){
                        $thead = "
                <thead>
                <tr>
                    <th colspan='7'>Amostra: $amostra[nomeAmostra]<br/>Data da aplicação: $amostra[dataAplicacao]</th>
                </tr>
                <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Nome</th>
                    <th scope='col'>E-mail</th>
                    <th scope='col' class='text-center'>Abstração</th>
                    <th scope='col' class='text-center'>Decomposição</th>
                    <th scope='col' class='text-center'>Rec. Padrões</th>
                    <th scope='col' class='text-center'>Algoritmos</th>
                </tr>
                </thead>
                <tbody>                    
                    ";

                        $cont++;
                        $tbody.= "
                            <tr> 
                                <th scope='col'>$cont</th>
                                <td>$amostra[nome]</td>
                                <td>$amostra[email]</td>
                                <td>$amostra[abstracao]</td>
                                <td>$amostra[decomposicao]</td>
                                <td>$amostra[reconhecimento]</td>
                                <td>$amostra[algoritmo]</td>
                            </tr>
                        ";
                    }
                    echo $thead.$tbody;
                }

                ?>
                </tbody>
            </table>
            <p><a href="dashboard.php" class="btn btn-outline-danger">Fechar relatório</a></p>
        </div>

        <div class="col">
        </div>
    </div>
</div>

</body>
</html>