<main>
    <section>
        <input type="hidden" id="paciente_id" name="paciente_id" value="{{ !empty($dados) ? $dados['paciente']->id : '' }}">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>Dados do paciente</h3>
            </div>
        </div>
        <hr style="margin-top: 0px;">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <label for="nome">Nome do paciente</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ !empty($dados) ? $dados['paciente']->nome : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control cpfMask" id="cpf" name="cpf" value="{{ !empty($dados) ? $dados['paciente']->cpf : '' }}">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="cns">CNS</label>
                        <input type="text" class="form-control cnsMask" id="cns" name="cns" value="{{ !empty($dados) ? $dados['paciente']->cns : '' }}">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="nascimento">Data de nascimento</label>
                        <input type="date" class="form-control" id="nascimento" name="nascimento" value="{{ !empty($dados) ? $dados['paciente']->nascimento : '' }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <label for="mae">Nome da mãe</label>
                        <input type="text" class="form-control" id="mae" name="mae" value="{{ !empty($dados) ? $dados['paciente']->mae : '' }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        @if (!empty($dados))
                            @if ($dados['paciente']->foto != "")
                                <label for="myFile">Foto do paciente</label>
                                <br>
                                <span>
                                    {{ $dados['paciente']->foto }}&nbsp;
                                    <input type="hidden" id="myFile" name="myFile" value="{{ $dados['paciente']->foto }}">
                                    <i class="fa fa-close" style="color: red; cursor: pointer;" onclick="deletaFile(event,{{ $dados['paciente']->id }},'{{ $dados['paciente']->foto }}');"></i>
                                </span>
                            @else
                                <form action="/foto/salvar" method="post" enctype="multipart/form-data" id="formEnviarFoto">
                                    <label for="myFile">Anexar foto</label>
                                    <input type="file" class="form-control" id="myFile" name="myFile" value="{{ !empty($dados) ? $dados['paciente']->foto : '' }}">
                                </form>
                            @endif
                        @else
                            <form action="/foto/salvar" method="post" enctype="multipart/form-data" id="formEnviarFoto">
                                <label for="myFile">Anexar foto</label>
                                <input type="file" class="form-control" id="myFile" name="myFile" value="{{ !empty($dados) ? $dados['paciente']->foto : '' }}">
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <fieldset class="fieldStyle">
            <legend style="width: auto;">Dados do endereço</legend>
            <hr style="margin-top: 0px;">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="cep">CEP</label>
                            <input type="text" onchange="buscaEndereco();" class="form-control cepMask" id="cep" name="cep" value="{{ !empty($dados) ? $dados['endereco']->cep : '' }}">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="endereco">Logradouro</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" value="{{ !empty($dados) ? $dados['endereco']->endereco : '' }}">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="numero">Número</label>
                            <input type="text" class="form-control" id="numero" name="numero" value="{{ !empty($dados) ? $dados['endereco']->numero : '' }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="complemento">Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento" value="{{ !empty($dados) ? $dados['endereco']->complemento : '' }}">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" value="{{ !empty($dados) ? $dados['endereco']->bairro : '' }}">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" value="{{ !empty($dados) ? $dados['endereco']->cidade : '' }}">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <label for="estado">UF</label>
                            <input type="text" class="form-control" id="estado" name="estado" value="{{ !empty($dados) ? $dados['endereco']->estado : '' }}">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </section>
</main>
<br>
<div class="row">
    <div class="col-md-12" style="text-align: center;">
        <input type="button" class="btn btn-outline-dark" value="Enviar dados" onclick="salvarDadosPaciente(event);">
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.cpfMask').mask('000.000.000-00');
        $('.cnsMask').mask('000000000000000');
        $('.cepMask').mask('00000-000');
    });

    var paciente_id = $("#paciente_id").val();

    function salvarDadosPaciente(e){
        e.preventDefault();

        var myFile = document.getElementById('myFile');
        
        var modal = {
            id:"modalIncluir",
            div:"attachModalBodySalvar",
            ancora:"ancora"
        };

        if(paciente_id !== ""){
            var url = '/paciente/' + paciente_id;
            var method = 'PUT';
        }else{
            var url = '/paciente/create';
            var method = 'POST';
        }

        
    }
</script>