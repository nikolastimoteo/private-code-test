@extends('adminlte::page')

@section('title', 'Cadastro de Cliente')

@section('content_header')
    <h1>Cadastro de Cliente</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-black">
            <div class="box-header with-border">
                <h3 class="box-title">Dados do Cliente</h3>
            </div>
            <!-- /.box-header -->
            <form action="{{ route('clientes.store') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                            placeholder="Digite o nome do cliente" required>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                            placeholder="Digite o e-mail do cliente" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group has-feedback">
                        <label for="include_phone">Telefones</label>
                        <div class="input-group">
                            <input type="text" id="include_phone" name="include_phone" class="form-control"
                                placeholder="Digite um número de telefone no formato +99 (99) 99999-9999 ou +99 (99) 9999-9999 e clique em adicionar">
                            <div class="input-group-btn">
                                <button type="button" class="btn bg-black btn-flat" id="add_button" title="Adicionar Telefone">Adicionar Telefone</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.form-group -->
                    <div id="phones">
                        @if(!is_null(old('phones')))
                            @foreach(old('phones') as $key => $phone)
                                <div class="form-group has-feedback {{ $errors->has('phones.' . $key) ? 'has-error' : '' }}">
                                    <div class="input-group">
                                        <input type="text" name="phones[]" class="form-control" value="{{ old('phones.' . $key) }}"placeholder="Digite o número do telefone no formato +99 (99) 99999-9999 ou +99 (99) 9999-9999" readonly required>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn bg-red btn-flat remove_button" title="Remover Telefone"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @if($errors->has('phones.' . $key))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phones.' . $key) }}</strong>
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- /#phones -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="{{ route('clientes.index') }}" class="btn btn-flat btn-danger pull-left" title="Cancelar">Cancelar</a>
                            <button type="submit" class="btn btn-flat btn-primary pull-right" title="Salvar Cliente">Salvar Cliente</button>
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
        $('#include_phone').inputmask('+99 (99) 9999[9]-9999', {placeholder: "", showMaskOnFocus: false, showMaskOnHover: false});

        $('#add_button').on('click', function(){
            var phone = $('#include_phone').val();
            if(phone !== "" && $('#include_phone').inputmask("isComplete")){
                $('#phones').append('<div class="form-group">' +
                                        '<div class="input-group">' +
                                            '<input type="text" name="phones[]" class="form-control" value="'+phone+'"placeholder="Digite o número do telefone no formato +99 (99) 99999-9999 ou +99 (99) 9999-9999" readonly required>' +
                                            '<div class="input-group-btn">' +
                                                '<button type="button" class="btn bg-red btn-flat remove_button" title="Remover Telefone"><i class="fa fa-trash"></i></button>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>');
                $('#include_phone').val('');
            }
        });

        $('#phones').on('click', '.remove_button', function () {
            $(this).parent('div').parent('div').parent('div').remove();
        });
    });
</script>
@stop