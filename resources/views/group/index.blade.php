@extends('adminlte::page')

@section('title', 'Grupos')

@section('content_header')
    <h1>Grupos <small>Todos os grupos cadastrados</small></h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-black">
            <div class="box-header with-border">
                <div class="col-xs-12 col-sm-6 col-lg-4">
                    <a href="{{ route('grupos.create') }}" title="Cadastrar Grupo">                           
                        <div class="small-box bg-black">
                            <div class="inner">
                                <h3>Novo</h3>
                                <p>Grupo</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-people"></i>
                            </div>
                            <span class="small-box-footer">Cadastrar <i class="fa fa-arrow-circle-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 table table-responsive">
                        <table id="groups-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Permissões</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td style="vertical-align: middle">{{ $group->display_name }}</td>
                                        <td style="vertical-align: middle">
                                            @foreach ($group->permissions as $permission)
                                                <small class="label pull-right bg-black" style="margin-left: 5px;">{{ $permission->display_name }}</small>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('grupos.show', ['id' => $group->id]) }}" type="button" class="btn btn-primary btn-flat" title="Visualizar Grupo"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('grupos.edit', ['id' => $group->id]) }}" type="button" class="btn btn-warning btn-flat" title="Editar Grupo"><i class="fa fa-pencil-alt"></i></a>
                                                <a href="#" onclick="confirmarExclusao({{ $group->id }}, '{{ $group->display_name }}')" data-toggle="modal" data-target="#modal-exclusao" class="btn btn-danger btn-flat" title="Excluir Grupo">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>Permissões</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<!-- Modal de exclusão -->
<div class="modal fade" id="modal-exclusao" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-exclusao" action="#" method="post">
                {!! csrf_field() !!}
                @method('DELETE')
                <div class="modal-header">
                    <h4 class="modal-title">Confirmação de Exclusão</h4>
                </div>
                <div class="modal-body">
                    <div id="form-exclusao-texto">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-flat btn-default pull-left" data-dismiss="modal">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-flat btn-danger pull-right">
                        Confirmar
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@stop

@section('css')
@stop

@section('js')
<script>
    $(function () {
        $('#groups-table').DataTable({
            language: {
                decimal: ",",
                processing: "Processando...",
                search: "Pesquisar:",
                lengthMenu: "_MENU_ resultados por página",
                info: "Mostrando de _START_ até _END_ de _TOTAL_ grupos",
                infoEmpty: "Mostrando 0 até 0 de 0 grupos",
                infoFiltered: "(Filtrados de _MAX_ grupos)",
                infoPostFix: "",
                loadingRecords: "Carregando...",
                zeroRecords: "Nenhum grupo encontrado",
                emptyTable: "Nenhum grupo encontrado",
                paginate: {
                    first: "Primeiro",
                    previous: "Anterior",
                    next: "Próximo",
                    last: "Último"
                },
                aria: {
                    sortAscending: ": Ordenar colunas de forma ascendente",
                    sortDescending: ": Ordenar colunas de forma descendente"
                },
            },
            pageLength: 50
        });
    });
    // Função para preparar o modal de exclusão
    function confirmarExclusao(id, nome) {
        $('#form-exclusao').attr('action', '/grupos/'+id);
        $('#form-exclusao').children('.modal-body').children('#form-exclusao-texto').remove();
        $('#form-exclusao').children('.modal-body').append('<div id="form-exclusao-texto"><h4>Deseja confirmar a exclusão do grupo "<strong>'+nome+'</strong>"?</h4></div>');
    }
</script>
@stop