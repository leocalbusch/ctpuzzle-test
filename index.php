<?php
session_start();
$_SESSION=array();
session_destroy();
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
    <title>CT Puzzle Test</title>
    <style>
        @media screen and (max-width: 767px) {
            .ml-auto {
                margin-right: auto!important;
                margin-left:0px!important;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">CT Puzzle Test</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><button class="btn px-0 nav-link" type="button" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-sign-in mr-sm-1"></i>Entrar</button></li>
            <li class="nav-item"><button class="btn nav-link" type="button" data-toggle="modal" data-target="#modalEsqueceu"><i class="fa fa-lock mr-sm-1"></i><i class="fa fa-question mr-sm-1"></i>Recuperar senha</button></li>
            <li class="nav-item"><button class="btn nav-link" type="button" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-user-plus mr-sm-1"></i>Cadastrar-se</button></li>
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
                <p><a class="btn btn-success" style="color:#fff;" href="novoCadastro.php?tipo=3">Área do Estudante</a></p>
                <p><a class="btn btn-warning" href="novoCadastro.php?tipo=2">Área do Aplicador</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalEsqueceu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CT Puzzle Test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="esqueceuSenha.php">
                <div class="modal-body">
                <p>Esqueceu sua senha? Informe abaixo seu e-mail e lhe enviaremos um link para que você possa cadastrar uma nova senha.</p>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="esqueceuEmail">Seu e-mail</label>
                        <input class="form-control" type="email" placeholder="e-mail"
                               aria-label="e-mail" required name="esqueceuEmail">
                    </div>
                    <div class="col-sm-6"></div>
                </div>
                <button class="btn btn-primary">Recuperar senha</button>
            </form>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CT Puzzle Test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="processaLogin.php">
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="loginEmail">Seu e-mail</label>
                            <input class="form-control" type="email" placeholder="e-mail"
                                   aria-label="e-mail" required name="loginEmail">
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="loginSenha">Sua senha</label>
                            <input class="form-control" type="password" placeholder="senha" aria-label="senha" required name="loginSenha">
                        </div>
                        <div class="col-sm-6"></div>
                    </div>
                    <button class="btn btn-primary">Entrar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
        </div>
        <div class="col">
            <h1>Bem-vindo(a) ao CT Puzzle Test!</h1>
            <p>Utilize o menu superior para ter acesso às opções do site.</p>
        </div>
        <div class="col">
        </div>
    </div>
</div>

</body>
</html>