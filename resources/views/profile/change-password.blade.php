@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Meu Perfil</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Alteração de Senha</h3>
            </div>
            <!-- /.box-header -->
            <form action="{{ route('postChangePassword') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">Nova Senha</label>
                        <input type="password" name="password" id="password" class="form-control"
                               placeholder="Digite a nova senha" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        <label for="password_confirmation">Confirmação da Nova Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                               placeholder="Confirme a nova senha" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="{{ route('getHome') }}" class="btn btn-flat btn-danger pull-left" title="Cancelar">Cancelar</a>
                            <button type="submit" class="btn btn-flat btn-success pull-right" title="Alterar Senha">Alterar Senha</button>
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
        <div class="box box-default">
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