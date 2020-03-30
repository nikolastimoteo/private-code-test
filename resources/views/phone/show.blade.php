@extends('adminlte::page')

@section('title', 'Visualização de Telefone')

@section('content_header')
    <h1>Visualização de Telefone</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-black">
            <div class="box-header with-border">
                <h3 class="box-title">Dados do Telefone</h3>
            </div>
            <!-- /.box-header -->
            <form autocomplete="off">
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('clients_id') ? 'has-error' : '' }}">
                        <label for="clients_id">Número</label>
                        <input type="text" name="clients_id" id="clients_id" class="form-control" value="{{ $phone->client->name }}"
                            required readonly>
                        @if ($errors->has('clients_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('clients_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group has-feedback {{ $errors->has('number') ? 'has-error' : '' }}">
                        <label for="number">Número</label>
                        <input type="text" name="number" id="number" class="form-control" value="{{ $phone->number }}"
                            placeholder="Digite o número do telefone" required readonly>
                        @if ($errors->has('number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('number') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="{{ route('telefones.index') }}" class="btn btn-flat btn-default pull-left" title="Voltar">Voltar</a>
                            <a href="{{ route('telefones.edit', ['id' => $phone->id]) }}" class="btn btn-flat btn-warning pull-right" title="Editar Telefone">Editar Telefone</a>
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
@stop