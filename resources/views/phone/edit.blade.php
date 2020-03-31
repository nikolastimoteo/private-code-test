@extends('adminlte::page')

@section('title', 'Edição de Telefone')

@section('content_header')
    <h1>Edição de Telefone</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-black">
            <div class="box-header with-border">
                <h3 class="box-title">Dados do Telefone</h3>
            </div>
            <!-- /.box-header -->
            <form action="{{ route('telefones.update', ['id' => $phone->id]) }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                @method('PUT')
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('clients_id') ? 'has-error' : '' }}">
                        <label for="clients_id">Cliente</label>
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
                        <input type="text" name="number" id="number" class="form-control" value="{{ old('number', $phone->number) }}"
                            placeholder="Digite o número do telefone no formato +99 (99) 99999-9999 ou +99 (99) 9999-9999" required>
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
                            <a href="{{ route('telefones.index') }}" class="btn btn-flat btn-danger pull-left" title="Cancelar">Cancelar</a>
                            <button type="submit" class="btn btn-flat btn-primary pull-right" title="Salvar Alterações">Salvar Alterações</button>
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
<script src="{{ asset('vendor/adminlte/vendor/input-mask/jquery.inputmask.js') }}"></script>
<script>
    $(function () {
        $(".select2").select2();
        $('#number').inputmask('+99 (99) 9999[9]-9999', {placeholder: "", showMaskOnFocus: false, showMaskOnHover: false});
    });
</script>
@stop