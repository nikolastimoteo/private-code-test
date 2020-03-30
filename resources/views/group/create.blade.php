@extends('adminlte::page')

@section('title', 'Cadastro de Grupo')

@section('content_header')
    <h1>Cadastro de Grupo</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-black">
            <div class="box-header with-border">
                <h3 class="box-title">Dados do Grupo</h3>
            </div>
            <!-- /.box-header -->
            <form action="{{ route('grupos.store') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('display_name') ? 'has-error' : '' }}">
                        <label for="display_name">Nome</label>
                        <input type="text" name="display_name" id="display_name" class="form-control" value="{{ old('display_name') }}"
                            placeholder="Digite o nome do grupo" required>
                        @if ($errors->has('display_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('display_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group has-feedback {{ $errors->has('permissions') ? 'has-error' : '' }}">
                        <label for="permissions">Permissões</label>
                        <select id="permissions" name="permissions[]" multiple="multiple"class="form-control select2" style="width: 100%;" required>
                            <option value="">Selecione as permissões...</option>
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->display_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('permissions'))
                            <span class="help-block">
                                <strong>{{ $errors->first('permissions') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="{{ route('grupos.index') }}" class="btn btn-flat btn-danger pull-left" title="Cancelar">Cancelar</a>
                            <button type="submit" class="btn btn-flat btn-primary pull-right" title="Salvar Grupo">Salvar Grupo</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </form>
            <!-- /form -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4">
        <div class="box box-black">
            <div class="box-header with-border">
                <h3 class="box-title"> Ajuda </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
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
        $(".select2").select2();
    });
</script>
@stop