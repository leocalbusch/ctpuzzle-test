<?php
require "sessao.php";
require "conexao.php";
$sql = "SELECT * FROM amostras WHERE idAplicador = " . $_SESSION["idUsuario"];
require "executaQuery.php";
if (mysqli_num_rows($result) > 0) {
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
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
            $('#exampleModal2').on('hide.bs.modal', function (e) {
                window.location.href = "index.php";
            })
        });

    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
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
            <?php
            if ($_SESSION["tipoUsuario"] == 2) {
                echo '
            <li class="nav-item" >
                <button class="btn nav-link" type = "button" data-toggle = "modal" data-target = "#minhasAmostras" ><i class="fa fa-signal mr-sm-1" ></i >Minhas Amostras</button >
            </li >';
            }
            ?>
            <li class="nav-item">
                <button class="btn nav-link" type="button" data-toggle="modal" data-target="#exampleModal"><i
                            class="fa fa-sign-out mr-sm-1"></i>Sair
                </button>
            </li>
        </ul>
    </div>
</nav>
<!-- Modal -->
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
                <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal"
                        data-target="#exampleModal2">Sim, quero sair
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal 2-->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <p>Saída efetuada com sucesso.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Minhas Amostras -->
<div class="modal fade" id="minhasAmostras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <p>Minhas Amostras</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Salvar Alterações</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
        </div>
        <div class="col">
            <?php
            if ($_SESSION["tipoUsuario"] == 3) {
                echo "<p>Olá $_SESSION[nome]! Para iniciar seu teste, você precisa informar sua chave! Ainda não possui uma? Consulte a pessoa responsável pela aplicacão do teste!</p>
            <form action='processaVinculaAmostra.php' method='post' >
                <div class='form-group'>
                    <label for='chaveAmostra'>Chave:</label>
                    <input type='text' class='form-control' id='chaveAmostra' name='chaveAmostra'>
                </div>
                <button type='submit' class='btn btn-primary'>Iniciar</button>
            </form>";
            }
            if ($_SESSION["tipoUsuario"] == 2) {

                echo '<p>Olá ' . $_SESSION[nome] . '! Para iniciar seu teste, você precisa cadastrar uma amostra e atribuir uma chave de cesso a ela.</p>
            <form action="processaNovaAmostra.php" method="post" >
                <div class="form-group">
                    <label for="cadastroNome">Nome identificador da amostra</label>
                    <input type="text" class="form-control" id="cadastroNome" name="cadastroNome" required>
                </div>
                 <div class="form-group">
                    <label for="cadastroDescricao">Descrição da amostra</label>
                    <textarea class="form-control" id="cadastroDescricao" name="cadastroDescricao" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="cadastroData">Data de aplicação</label>
                    <input type="date" class="form-control" id="cadastroData" name="cadastroData" required>
                </div>                
                <div class="form-group">
                    <label for="cadastroChave">Chave de acesso aos estudantes</label>
                    <input type="text" class="form-control" id="cadastroChave" name="cadastroChave" required>
                </div>
                 <div class="form-group">
                    <label for="cadastroInstituicao">Nome da Instituição</label>
                    <input type="text" class="form-control" id="cadastroInstituicao" name="cadastroInstituicao" required>
                </div>   
                 <div class="form-group">
                    <label for="cadastroCidade">Cidade</label>
                    <input type="text" class="form-control" id="cadastroCidade" name="cadastroCidade" required>
                </div> 
                 <div class="form-group">
                    <label for="cadastroEstado">Estado</label>
                    <input type="text" class="form-control" id="cadastroEstado" name="cadastroEstado" required>
                </div> 
                 <div class="form-group">
                    <label for="cadastroPais">País</label>
                    <input type="text" class="form-control" id="cadastroPais" name="cadastroPais" required>
                </div>                                                             
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>';
            }
            ?>
        </div>
        <div class="col">
        </div>
    </div>
</div>

</body>
</html>
