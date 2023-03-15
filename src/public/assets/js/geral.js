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
    let altura    = '30vw';
    let msg       = '';
    let titulo    = '';
    let id        = 'myModal';
    let div       = 'attachModalBody';
    let callback  = '';
    let url       = '';
    let reopen    = '';
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
    }
    
    if((ancora == '') || (ancora.length < 1)){
        alert('Nenhuma ancora foi achada. Verifique com um programador');
    }else{
        $("#" + div).remove();

        modalBody += '<div id="' + div + '">';
        modalBody += '<div class="modal fade" id="' + id + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">';
        modalBody += '<div style="min-width: ' + tamanho + ';" class="modal-dialog modal-dialog-centered" role="document">';
        modalBody += '<div class="modal-content">';
        modalBody += '<div class="modal-header" style="background: #031a61;color: #fff;border-radius: 0px;">';
        modalBody += '<h5 style="color: #fff;" class="modal-title" id="exampleModalLongTitle">' + titulo + '</h5>';
        modalBody += '<button type="button" onclick="closeTheModal(\''+id+'\', \''+ancora+'\', \''+reopen+'\', \''+callback+'\', \''+url+'\');" class="close" data-dismiss="modal" aria-label="Close">';
        modalBody += '<span aria-hidden="true" style="color: #fff;">&times;</span>';
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

            if(callback == 'on_hide_reopen'){
                $('#' + id).on('hidden.bs.modal', function () {
                    $("#" + reopen).removeClass('hide');
                    $("#" + reopen).addClass('show');
                })
            }
        }
    }
}

function closeTheModal(id = "", ancora = "", reopen = "", callback = "", url = ""){
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