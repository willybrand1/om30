function carregando(exibirCarregando){
    if(exibirCarregando == false){
        $(".loading-dialog").css("display","none");
    }else{
        $(".loading-dialog").css("display","block");
    }
};

function createModal(obj = {}){
    let modalBody = '';
    let ancora    = 'ancora';
    let tamanho   = '40%';
    let altura    = '30vw !important';
    let msg       = '';
    let titulo    = '';
    let id        = 'myModal';
    let div       = 'attachModalBody';
    let callback  = '';
    let url       = '';
    let reopen    = '';
    let headstyle = 'background: #031a61;color: #fff;border-radius: 0px;font-size: 1.3rem;font-weight: 500;';
    let entries   = Object.entries(obj);
    
    for(var i=0; i<entries.length; i++){
        if(entries[i][0] == "tamanho"){
            tamanho = entries[i][1];
        }
        if(entries[i][0] == "altura"){
            altura = entries[i][1];
        }
        if(entries[i][0] == "msg"){
            msg = entries[i][1];
        }
        if(entries[i][0] == "titulo"){
            titulo = entries[i][1];
        }
        if(entries[i][0] == "ancora"){
            ancora = entries[i][1];
        }
        if(entries[i][0] == "id"){
            id = entries[i][1];
        }
        if(entries[i][0] == "div"){
            div = entries[i][1];
        }
        if(entries[i][0] == "callback"){
            callback = entries[i][1];
        }
        if(entries[i][0] == "url"){
            url = entries[i][1];
        }
        if(entries[i][0] == "reopen"){
            reopen = entries[i][1];
        }
        if(entries[i][0] == "headcolor"){
            headstyle = entries[i][1];
        }
    }
    
    if((ancora == '') || (ancora.length < 1)){
        alert('Nenhuma ancora foi achada. Verifique com um programador');
    }else{
        $("#" + div).remove();

        modalBody += '<div id="' + div + '">';
        modalBody += '<div data-backdrop="static" data-keyboard="false" class="modal fade" id="' + id + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
        modalBody += '<div style="min-width: ' + tamanho + ';" class="modal-dialog modal-dialog-centered" role="document">';
        modalBody += '<div class="modal-content" style="height: auto;">';
        modalBody += '<div class="modal-header" style="' + headstyle + 'border-radius: 0px;">';
        modalBody += '<span class="modal-title" id="exampleModalLongTitle">' + titulo + '</span>';
        modalBody += '<button type="button" onclick="closeTheModal(\''+id+'\', \''+ancora+'\', \''+reopen+'\', \''+callback+'\', \''+url+'\');" class="close" data-dismiss="modal" aria-label="Close">';
        modalBody += '<span aria-hidden="true">&times;</span>';
        modalBody += '</button>';
        modalBody += '</div>';
        modalBody += '<div class="modal-body" style="overflow: auto;max-height: ' + altura + ';">';
        modalBody += msg;
        modalBody += '</div>';
        modalBody += '</div>';
        modalBody += '</div>';
        modalBody += '</div>';
        modalBody += '</div>';

        $("#" + ancora).html(modalBody);
        $("#" + id).modal('show');
        
        if(callback !== ''){
            if(callback == 'on_hide_reload'){
                $('#' + id).on('hidden.bs.modal', function () {
                    location.reload();
                })
            }

            if(callback == 'on_hide_redirect'){
                $('#' + id).on('hidden.bs.modal', function () {
                    if(url == ""){
                        alert('Nenhum endereço foi encontrado para o redirecionamento.');
                        return false;
                    }else{
                        window.location.href = url;
                    }
                })
            }
        }
    }
}

function closeTheModal(id,ancora,reopen,callback,url){
    $("#" + id).modal('hide');
    $("#" + ancora).html("");
    
    if(reopen !== ""){
        $("#" + reopen).removeClass('hide');
        $("#" + reopen).addClass('show');
    }

    if(callback !== ''){
        if(callback == 'on_hide_reload'){
            location.reload();
        }

        if(callback == 'on_hide_redirect'){
            if(url == ""){
                alert('Nenhum endereço foi encontrado para o redirecionamento.');
                return false;
            }else{
                window.location.href = url;
            }
        }
    }

    $(".modal-fade").modal("hide");
    $('body').removeClass('modal-open');
}

function buscaEndereco(){
    let cep = $("#cep").val();

    if(cep !== ""){
        var modal = {
            id:"modalCep",
            div:"attachModalBodyCep",
            ancora:"ancora2"
        };

        cep = parseInt(cep.toString().replace(/-/, ''), 10);
        
        $.ajax({
            url: 'https://viacep.com.br/ws/' + cep + '/json/',
            method: 'GET',
            dataType: 'json'
        }).done(function(obj){
            $("#endereco").val('');
            $("#numero").val('');
            $("#complemento").val('');
            $("#bairro").val('');
            $("#cidade").val('');
            $("#estado").val('');

            $("#endereco").val(obj.logradouro);
            $("#complemento").val(obj.complemento);
            $("#bairro").val(obj.bairro);
            $("#cidade").val(obj.localidade);
            $("#estado").val(obj.uf);
        }).fail(function(xhr){
            if(xhr.status == 404){
                modal['msg'] = "Erro [404]: Página não encontrada.";
            }else if(xhr.status == 500){
                modal['msg'] = "Erro [500]: Erro ao retornar requisição do servidor.";
            }
    
            modal['titulo'] = "Erro";
            modal['tamanho'] = "30%";
            
            createModal(modal);
        });
    }
}

function incluir(){
    var modal = {
        id:"modalIncluir",
        div:"attachModalBodyIncluir",
        ancora:"ancora"
    };

    $.ajax({
        url: '/paciente/modal',
        method: 'GET',
        dataType: 'text',
        data: {
            modal:'paciente'
        }
    }).done(function(obj){
        modal['msg'] = obj;
        modal['titulo'] = "Cadastrar novo Paciente";
        modal['tamanho'] = "80%";

        createModal(modal);
    }).fail(function(xhr){
        if(xhr.status == 404){
            modal['msg'] = "Erro [404]: Página não encontrada.";
        }else if(xhr.status == 500){
            modal['msg'] = "Erro [500]: Erro ao retornar requisição do servidor.";
        }

        modal['titulo'] = "Erro";
        modal['tamanho'] = "30%";
        
        createModal(modal);
    });
}

function pesquisar(){
    var filNome = $("#filNome").val();
    var filCpf = $("#filCpf").val();

    $('#tbPaciente').DataTable().clear().destroy();

    $('#tbPaciente').DataTable({
        processing: true,
        serverSide: true,
        fixedHeader: false,
        responsive: true,
        deferRender: true,
        searching: true,
        autoWidth: true,
        pageLength: 2,
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
        },
        ajax: {
            url: "/api/paciente/list",
            method: "GET",
            data: {
                filNome:filNome,
                filCpf:filCpf
            }
        },
        columns: [
            {data: 'nome', name: 'nome'},
            {data: 'mae', name: 'mae'},
            {data: 'nascimento', name: 'nascimento'},
            {data: 'cpf', name: 'cpf'},
            {data: 'cns', name: 'cns'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
}

function limpar(){
    $("#filNome").val('');
    $("#filCpf").val('');

    $('#tbPaciente').DataTable().clear().destroy();
}