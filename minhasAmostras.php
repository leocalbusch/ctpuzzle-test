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
                <p>Minhas Amostras</p>
                <table class="table table-sm table-hover" id="minhaAmostra">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Identificação</th>
                        <th scope="col">Chave</th>
                        <th scope="col">Aberta</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "select a.*, count(ar.idAmostra) as respostas FROM amostras a left join amostras_resultados ar ON a.idAmostra = ar.idAmostra where a.idAplicador = ".$_SESSION["idUsuario"]." group by a.idAmostra";
                    require "executaQuery.php";
                    $msgRodape[1] = "Ops! Parece que você ainda não possui amostras cadastradas!";
                    $msgRodape[0] = "<span class='badge badge-pill badge-primary'>?</span> = quantidade de respostas";
                    $cont = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($amostra = mysqli_fetch_array($result)){
                            $cont++;
                            echo "
                            <tr> 
                                <th scope='rol'>$cont</th>
                                <td><a style='cursor: pointer;' data-idamostra='$amostra[idAmostra]' data-toggle='modal' data-target='#editarAmostra'>$amostra[nome]</a> <span class='badge badge-pill badge-primary'>$amostra[respostas]</span></td>
                                <td><a style='cursor: pointer;' data-idamostra='$amostra[idAmostra]' data-toggle='modal' data-target='#editarAmostra'>$amostra[chave]</a></td>
                                <td><input type='checkbox' class='form-check-input' name='amostras[]' value='$amostra[idAmostra]'" . ($amostra[aberta]?"checked":"") . "></td>
                            </tr>
                        ";
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <p><?php echo $msgRodape[$cont==0]; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <?php if($cont>0){ ?><button type="submit" class="btn btn-primary">Salvar Alterações</button><?php } ?>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editarAmostra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
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