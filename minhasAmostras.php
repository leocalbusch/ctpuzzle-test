<!-- Modal Minhas Amostras -->
<div class="modal fade" id="minhasAmostras" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="processaStatusAmostra.php" method="post" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CT Puzzle Test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Minhas Amostras</h5>
                <p>Aqui você administra suas amostras de aplicação do CT Puzzle Test. Para liberar ou bloquear o acesso de uma amostra ao teste, basta marcar/desmarcar a caixa de seleção correspondente e clicar em "Salvar Alterações". Para atualizar outros dados de uma amostra, clique sobre o nome da amostra que deseja alterar.</p>
                <table class="table table-sm table-hover mb-0" id="minhaAmostra">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Chave</th>
                        <th scope="col" class='text-center'>Liberada</th>
                        <th scope="col" class='text-center'>Resultados</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "select a.*, count(ar.idAmostra) as respostas FROM amostras a left join amostras_resultados ar ON a.idAmostra = ar.idAmostra where a.idAplicador = ".$_SESSION["idUsuario"]." group by a.idAmostra";
                    require "executaQuery.php";
                    $msgRodape[1] = "<p class='text-center'>Ops! Parece que você ainda não possui amostras cadastradas!</p>";
                    $msgRodape[0] = "<ul class='list-inline d-flex justify-content-between'><li class='list-inline-item'><span class='badge badge-primary'><i class='fa fa-bar-chart' ></i></span> <span> = ver relatório</span></li><li class='list-inline-item'><span class='ml-auto'><span class='badge badge-pill badge-danger ml-auto'>?</span><span> = quantidade de respostas</span></span></li></ul>";
                    $cont = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($amostra = mysqli_fetch_array($result)){
                            $cont++;
                            echo "
                            <tr> 
                                <th scope='col'>$cont</th>
                                <td><a style='cursor: pointer;' data-idamostra='$amostra[idAmostra]' data-toggle='modal' data-target='#editarAmostra'>$amostra[nome]</a></td>
                                <td><span>$amostra[chave]</span></td>
                                <td class='text-center'><input type='checkbox' class='form-check-input position-static mx-auto' name='amostras[]' value='$amostra[idAmostra]'" . ($amostra[aberta]?"checked":"") . "></td>
                                <td class='text-center'><a href='relatorio.php?idAmostra=$amostra[idAmostra]' class='badge badge-primary'><i class='fa fa-bar-chart' ></i></a> <span class='badge badge-pill badge-danger'>$amostra[respostas]</span></td>
                            </tr>
                        ";
                        }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5"><button class="btn btn-outline-primary btn-sm btn-block" type = "button" data-toggle = "modal" data-target = "#modalNovaAmostra" ><i class="fa fa-plus-circle" ></i > Nova Amostra</button ></td>
                    </tr>
                    </tfoot>
                </table>
                <?php echo $msgRodape[$cont==0]; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <?php if($cont>0){ ?><button type="submit" class="btn btn-primary">Salvar Alterações</button><?php } ?>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Amostra -->
<div class="modal fade" id="editarAmostra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="processaNovaAmostra.php" method="post" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CT Puzzle Test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Altere as informações da sua amostra.</p>
                    <form action="processaNovaAmostra.php" method="post" >
                        <input type="hidden" id="idAmostra" name="idAmostra"/>
                        <input type="hidden" id="editar" name="editar" value="1"/>
                        <div class="form-group">
                            <label for="cadastroNome">Nome identificador da amostra</label>
                            <input type="text" class="form-control" id="editaNome" name="cadastroNome" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroDescricao">Descrição da amostra</label>
                            <textarea class="form-control" id="editaDescricao" name="cadastroDescricao" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cadastroData">Data de aplicação</label>
                            <input type="date" class="form-control" id="editaData" name="cadastroData" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroChave">Chave de acesso aos estudantes</label>
                            <input type="text" class="form-control" id="editaChave" name="cadastroChave" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroInstituicao">Nome da Instituição</label>
                            <input type="text" class="form-control" id="editaInstituicao" name="cadastroInstituicao" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroCidade">Cidade</label>
                            <input type="text" class="form-control" id="editaCidade" name="cadastroCidade" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroEstado">Estado</label>
                            <input type="text" class="form-control" id="editaEstado" name="cadastroEstado" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroPais">País</label>
                            <input type="text" class="form-control" id="editaPais" name="cadastroPais" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Nova Amostra-->
<div class="modal fade" id="modalNovaAmostra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CT Puzzle Test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?php
            if ($_SESSION["tipoUsuario"] == 2) {?>

            <h3>Cadastrar uma nova amostra</h3>
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
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <?php if($_SESSION["tipoUsuario"] == 2){ ?>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form><?php } ?>
            </div>
        </div>
    </div>
</div>