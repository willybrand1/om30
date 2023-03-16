@extends('layout.base')
@section('content')
{{ csrf_field()}}
<main>
    <div id="ancora"></div>
    <div id="ancora2"></div>
    <section>
        <div class="container-fluid">
            <div class="container">
                <h2><i class="fa fa-user"></i> Paciente</h2>
                <fieldset class="fieldStyle">
                    <legend style="width: auto;">Filtro</legend>
                    <div class="row" style="width: 100%;">
                        <div class="col-sm-12 col-md-6">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="filNome">Nome</label>
                                    <input type="text" id="filNome" class="form-control" placeholder="Nome do paciente">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="filCpf">CPF</label>
                                    <input type="text" id="filCpf" class="form-control" placeholder="CPF">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" style="width: 100%;">
                        <div class="col-sm-12 col-md-12" style="text-align: center;">
                            <button class="btn btn-outline-dark" id="btnPesquisar" onclick="pesquisar();">Pesquisar</button>
                            <button class="btn btn-outline-dark" id="btnPesquisar" onclick="exportar();">Exportar</button>
                            <button class="btn btn-outline-dark" id="btnPesquisar" onclick="incluir();">Incluir</button>
                            <button class="btn btn-outline-dark" id="btnPesquisar" onclick="limpar();">Limpar</button>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fieldStyle">
                    <legend style="width: auto;">Resultado da pesquisa</legend>
                    <table style="width: 100%;" id="tbPaciente" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Nome da mãe</th>
                                <th>Dta de nascimento</th>
                                <th>CPF</th>
                                <th>CNS</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </fieldset> 
            </div>
        </div>
    </section>
</main>
@endsection