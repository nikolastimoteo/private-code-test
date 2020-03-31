@extends('adminlte::page')

@section('title', 'Log de Atividades')

@section('content_header')
    <h1>Log de Atividades <small>@can('view-log') Todos os @else Meus @endcan logs registrados</small></h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom" style="cursor: move;">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right ui-sortable-handle">
                <li class="active"><a href="#my-log" data-toggle="tab">Minhas Atividades</a></li>
                @can('view-log')
                    <li><a href="#log" data-toggle="tab">Todas as Atividades</a></li>
                @endcan
                <li class="pull-left header"><i class="fa fa-inbox"></i> Log de Atividades</li>
            </ul>
            <div class="tab-content">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="my-log">
                    <div class="row">
                        <div class="col-xs-12 table table-responsive">
                            <table id="my-log-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Data e Hora</th>
                                        <th>Tipo</th>
                                        <th>Objeto</th>
                                        <th>Responsável</th>
                                        <th>Descrição</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Auth::user()->activityLogs as $log)
                                        <tr>
                                            <td style="vertical-align: middle">{{ date('d/m/Y à\s H:i:s', strtotime($log->created_at)) }}</td>
                                            <td style="vertical-align: middle">{{ $log->type }}</td>
                                            <td style="vertical-align: middle">{{ $log->modelObject() }}</td>
                                            <td style="vertical-align: middle">{{ $log->user->name }}</td>
                                            <td style="vertical-align: middle">{{ $log->description }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Data e Hora</th>
                                        <th>Tipo</th>
                                        <th>Objeto</th>
                                        <th>Responsável</th>
                                        <th>Descrição</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                @can('view-log')
                    <div class="chart tab-pane" id="log">
                        <div class="row">
                            <div class="col-xs-12 table table-responsive">
                                <table id="log-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Data e Hora</th>
                                            <th>Tipo</th>
                                            <th>Objeto</th>
                                            <th>Responsável</th>
                                            <th>Descrição</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($logs as $log)
                                            <tr>
                                                <td style="vertical-align: middle">{{ date('d/m/Y à\s H:i:s', strtotime($log->created_at)) }}</td>
                                                <td style="vertical-align: middle">{{ $log->type }}</td>
                                                <td style="vertical-align: middle">{{ $log->modelObject() }}</td>
                                                <td style="vertical-align: middle">{{ $log->user->name }}</td>
                                                <td style="vertical-align: middle">{{ $log->description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Data e Hora</th>
                                            <th>Tipo</th>
                                            <th>Objeto</th>
                                            <th>Responsável</th>
                                            <th>Descrição</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@stop

@section('css')
@stop

@section('js')
<script>
    $(function () {
        @can('view-log')
            $('#log-table').DataTable({
                "ordering": false,
                "lengthChange": false,
                language: {
                    decimal: ",",
                    processing: "Processando...",
                    search: "Pesquisar:",
                    lengthMenu: "_MENU_ resultados por página",
                    info: "Mostrando de _START_ até _END_ de _TOTAL_ logs",
                    infoEmpty: "Mostrando 0 até 0 de 0 logs",
                    infoFiltered: "(Filtrados de _MAX_ logs)",
                    infoPostFix: "",
                    loadingRecords: "Carregando...",
                    zeroRecords: "Nenhum log encontrado",
                    emptyTable: "Nenhum log encontrado",
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
        @endcan
        $('#my-log-table').DataTable({
            "ordering": false,
            "lengthChange": false,
            language: {
                decimal: ",",
                processing: "Processando...",
                search: "Pesquisar:",
                lengthMenu: "_MENU_ resultados por página",
                info: "Mostrando de _START_ até _END_ de _TOTAL_ logs",
                infoEmpty: "Mostrando 0 até 0 de 0 logs",
                infoFiltered: "(Filtrados de _MAX_ logs)",
                infoPostFix: "",
                loadingRecords: "Carregando...",
                zeroRecords: "Nenhum log encontrado",
                emptyTable: "Nenhum log encontrado",
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
</script>
@stop