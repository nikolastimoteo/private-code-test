@extends('adminlte::page')

@section('title', 'Telefones')

@section('content_header')
    <h1>Telefones <small>Todos os telefones cadastrados</small></h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-black">
            @can('admin')
            <div class="box-header with-border">
                <div class="col-xs-12 col-sm-6 col-lg-4">
                    <a href="{{ route('telefones.create') }}" title="Cadastrar Telefone">                           
                        <div class="small-box bg-black">
                            <div class="inner">
                                <h3>Novo</h3>
                                <p>Telefone</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-phone-portrait"></i>
                            </div>
                            <span class="small-box-footer">Cadastrar <i class="fa fa-arrow-circle-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            <!-- /.box-header -->
            <div class="@can('admin') box-body @else box-header with-border @endcan">
                <div class="row">
                    <div class="col-xs-12 table table-responsive">
                        <table id="phones-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>E-mail</th>
                                    <th>Número</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($phones as $phone)
                                    <tr>
                                        <td style="vertical-align: middle">{{ $phone->client->name }}</td>
                                        <td style="vertical-align: middle">{{ $phone->client->email }}</td>
                                        <td style="vertical-align: middle">{{ $phone->number }}</td>
                                        <td>
                                            <div class="btn-group">
                                                @can('view-phone')
                                                    <a href="{{ route('telefones.show', ['id' => $phone->id]) }}" type="button" class="btn btn-primary btn-flat" title="Visualizar Telefone"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('edit-phone')
                                                    <a href="{{ route('telefones.edit', ['id' => $phone->id]) }}" type="button" class="btn btn-warning btn-flat" title="Editar Telefone"><i class="fa fa-pencil-alt"></i></a>
                                                @endcan
                                                @can('delete-phone')
                                                    <a href="#" onclick="confirmarExclusao({{ $phone->id }}, '{{ $phone->number }}')" data-toggle="modal" data-target="#modal-exclusao" class="btn btn-danger btn-flat" title="Excluir Telefone">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Cliente</th>
                                    <th>E-mail</th>
                                    <th>Número</th>
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

@can('delete-phone')
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
@endcan
@stop

@section('css')
@stop

@section('js')
<script>
    $(function () {
        $('#phones-table').DataTable({
            language: {
                decimal: ",",
                processing: "Processando...",
                search: "Pesquisar:",
                lengthMenu: "_MENU_ resultados por página",
                info: "Mostrando de _START_ até _END_ de _TOTAL_ telefones",
                infoEmpty: "Mostrando 0 até 0 de 0 telefones",
                infoFiltered: "(Filtrados de _MAX_ telefones)",
                infoPostFix: "",
                loadingRecords: "Carregando...",
                zeroRecords: "Nenhum telefone encontrado",
                emptyTable: "Nenhum telefone encontrado",
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
    @can('delete-phone')
        // Função para preparar o modal de exclusão
        function confirmarExclusao(id, telefone) {
            $('#form-exclusao').attr('action', '/telefones/'+id);
            $('#form-exclusao').children('.modal-body').children('#form-exclusao-texto').remove();
            $('#form-exclusao').children('.modal-body').append('<div id="form-exclusao-texto"><h4>Deseja confirmar a exclusão do telefone "<strong>'+telefone+'</strong>"?</h4></div>');
        }
    @endcan
</script>
@stop