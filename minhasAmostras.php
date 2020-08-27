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
                <p>Aqui você administra suas amostras de aplicação do CT Puzzle Test. Para liberar ou bloquear o acesso de uma amostra ao teste, basta marcar/desmarcar a caixa de seleção correspondente e clicar em "Salvar Alterações".</p><p>Para atualizar os demais dados de uma amostra, <strong>clique sobre o nome da amostra</strong> que deseja alterar.</p>
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
                    $msgRodape[0] = "<small><ul class='list-inline d-flex justify-content-between'><li class='list-inline-item'><span class='badge badge-primary'><i class='fa fa-bar-chart' ></i></span> <span> = ver relatório</span></li><li class='list-inline-item'><span class='ml-auto'><span class='badge badge-pill badge-danger ml-auto'>?</span><span> = quantidade de respostas</span></span></li></ul></small>";
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
                            <label for="cadastroNome">Nome identificador da amostra <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Nome da amostra" data-content="Dê um nome que identifique essa amostra, como por exemplo o nome de um projeto, o título de uma pesquisa, o nome da etapa do trabalho ao qual essa amostra se refere, etc."><i class='fa fa-question' ></i></span></label>
                            <input type="text" class="form-control" id="editaNome" name="cadastroNome" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroDescricao">Descrição da amostra <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Descrição da amostra" data-content="Descreva detalhes da amostra, como por exemplo o perfil dos estudantes, faixa etária, características do escopo da pesquisa relacionadas a essa amostra, e qualquer informação importante que possa ser relevante para a análise dos resultados."><i class='fa fa-question' ></i></span></label>
                            <textarea class="form-control" id="editaDescricao" name="cadastroDescricao" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cadastroData">Data de criação da amostra ou aplicação do teste <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Data de criação / aplicação" data-content="Se a data de aplicação do teste já estiver definida, ela pode ser informada aqui. Caso contrário, ou ainda se esta informação não se aplica a essa amostra, a data atual poderá ser utilizada para fins de registro no banco de dados."><i class='fa fa-question' ></i></span></label>
                            <input type="date" class="form-control" id="editaData" name="cadastroData"  required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroChave">Chave de acesso aos estudantes <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Chave de acesso aos estudantes" data-content="Crie uma chave única que pode ser formada por letras, números e caracteres especiais. Essa chave deverá ser informada para os estudantes. Cada estudante que utilizar essa chave será incluído automaticamente nessa amostra. Caso essa chave de acesso já tenha sido utilizada por outro(a) membro, será solicitado que você crie uma chave de acesso diferente."><i class='fa fa-question' ></i></span></label>
                            <input type="text" class="form-control" id="editaChave" name="cadastroChave" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroSerie">Série / Ano <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Série / Ano" data-content=" Informe a série ou o ano da turma, por exemplo 1a. série ou 2o. ano. Esta informação é importante para a segmentação dos resultados e permite uma análise estatística mais detalhada. Caso esta informação não se aplique à sua amostra, crie um identificador a seu critério."><i class='fa fa-question' ></i></span></label>
                            <input type="text" class="form-control" id="editaSerie" name="cadastroSerie" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroTurma">Turma <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Turma" data-content=" Informe a identificação da turma, por exemplo turma A ou turma 2. Esta informação é importante para a segmentação dos resultados e permite uma análise estatística mais detalhada. Caso esta informação não se aplique à sua amostra, crie um identificador a seu critério."><i class='fa fa-question' ></i></span></label>
                            <input type="text" class="form-control" id="editaTurma" name="cadastroTurma" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroInstituicao">Nome da Instituição <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Instituição" data-content="O nome da Instituição onde o teste será aplicado. Caso esta informação não se aplique à sua amostra, o(a) aplicador(a) pode informar o nome da Instituição a qual está vinculado(a)."><i class='fa fa-question' ></i></span></label>
                            <input type="text" class="form-control" id="editaInstituicao" name="cadastroInstituicao" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroCidade">Cidade <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Cidade" data-content="A cidade onde o teste será aplicado. Caso esta informação não se aplique à sua amostra, o(a) aplicador(a) pode informar a cidade da Instituição a qual está vinculado(a). "><i class='fa fa-question' ></i></span></label>
                            <input type="text" class="form-control" id="editaCidade" name="cadastroCidade" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroEstado">Estado <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Estado" data-content="O estado onde o teste será aplicado. Caso esta informação não se aplique à sua amostra, o(a) aplicador(a) pode informar o estado da Instituição a qual está vinculado(a). "><i class='fa fa-question' ></i></span></label>
                            <input type="text" class="form-control" id="editaEstado" name="cadastroEstado" required>
                        </div>
                        <div class="form-group">
                            <label for="cadastroPais">País <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="País" data-content="O país onde o teste será aplicado. Caso esta informação não se aplique à sua amostra, o(a) aplicador(a) pode informar o país da Instituição a qual está vinculado(a). "><i class='fa fa-question' ></i></span></label>
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
            <form action="processaNovaAmostra.php" method="post" id="formNovaAmostra">
                <div class="form-group">
                    <label for="cadastroNome">Nome identificador da amostra <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Nome da amostra" data-content="Dê um nome que identifique essa amostra, como por exemplo o nome de um projeto, o título de uma pesquisa, o nome da etapa do trabalho ao qual essa amostra se refere, etc."><i class='fa fa-question' ></i></span></label>
                    <input type="text" class="form-control" id="cadastroNome" name="cadastroNome" required>
                </div>
                <div class="form-group">
                    <label for="cadastroDescricao">Descrição da amostra <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Descrição da amostra" data-content="Descreva detalhes da amostra, como por exemplo o perfil dos estudantes, faixa etária, características do escopo da pesquisa relacionadas a essa amostra, e qualquer informação importante que possa ser relevante para a análise dos resultados."><i class='fa fa-question' ></i></span></label>
                    <textarea class="form-control" id="cadastroDescricao" name="cadastroDescricao" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="cadastroData">Data de criação da amostra ou aplicação do teste <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Data de criação / aplicação" data-content="Se a data de aplicação do teste já estiver definida, ela pode ser informada aqui. Caso contrário, ou ainda se esta informação não se aplica a essa amostra, a data atual poderá ser utilizada para fins de registro no banco de dados."><i class='fa fa-question' ></i></span></label>
                    <input type="date" class="form-control" id="cadastroData" name="cadastroData"  required>
                </div>
                <div class="form-group">
                    <label for="cadastroChave">Chave de acesso aos estudantes <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Chave de acesso aos estudantes" data-content="Crie uma chave única que pode ser formada por letras, números e caracteres especiais. Essa chave deverá ser informada para os estudantes. Cada estudante que utilizar essa chave será incluído automaticamente nessa amostra. Caso essa chave de acesso já tenha sido utilizada por outro(a) membro, será solicitado que você crie uma chave de acesso diferente."><i class='fa fa-question' ></i></span></label>
                    <input type="text" class="form-control" id="cadastroChave" name="cadastroChave" required>
                </div>
                <div class="form-group">
                    <label for="cadastroSerie">Série / Ano <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Série / Ano" data-content="Informe a série ou o ano da turma, por exemplo 1a. série ou 2o. ano. Esta informação é importante para a segmentação dos resultados e permite uma análise estatística mais detalhada. Caso esta informação não se aplique à sua amostra, crie um identificador a seu critério."><i class='fa fa-question' ></i></span></label>
                    <input type="text" class="form-control" id="cadastroSerie" name="cadastroSerie" required>
                </div>
                <div class="form-group">
                    <label for="cadastroTurma">Turma <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Turma" data-content="Informe a identificação da turma, por exemplo turma A ou turma 2. Esta informação é importante para a segmentação dos resultados e permite uma análise estatística mais detalhada. Caso esta informação não se aplique à sua amostra, crie um identificador a seu critério."><i class='fa fa-question' ></i></span></label>
                    <input type="text" class="form-control" id="cadastroTurma" name="cadastroTurma" required>
                </div>
                <div class="form-group">
                    <label for="cadastroInstituicao">Nome da Instituição <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Instituição" data-content="O nome da Instituição onde o teste será aplicado. Caso esta informação não se aplique à sua amostra, o(a) aplicador(a) pode informar o nome da Instituição a qual está vinculado(a)."><i class='fa fa-question' ></i></span></label>
                    <input type="text" class="form-control" id="cadastroInstituicao" name="cadastroInstituicao" required>
                </div>
                <div class="form-group">
                    <label for="cadastroCidade">Cidade <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Cidade" data-content="A cidade onde o teste será aplicado. Caso esta informação não se aplique à sua amostra, o(a) aplicador(a) pode informar a cidade da Instituição a qual está vinculado(a). "><i class='fa fa-question' ></i></span></label>
                    <input type="text" class="form-control" id="cadastroCidade" name="cadastroCidade" required>
                </div>
                <div class="form-group">
                    <label for="cadastroEstado">Estado <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="Estado" data-content="O estado onde o teste será aplicado. Caso esta informação não se aplique à sua amostra, o(a) aplicador(a) pode informar o estado da Instituição a qual está vinculado(a). "><i class='fa fa-question' ></i></span></label>
                    <input type="text" class="form-control" id="cadastroEstado" name="cadastroEstado" required>
                </div>
                <div class="form-group">
                    <label for="cadastroPais">País <span class='badge badge-pill badge-info' data-toggle="popover" data-trigger="hover" title="País" data-content="O país onde o teste será aplicado. Caso esta informação não se aplique à sua amostra, o(a) aplicador(a) pode informar o país da Instituição a qual está vinculado(a). "><i class='fa fa-question' ></i></span></label>
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
