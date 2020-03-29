@extends('adminlte::page')

@section('title', 'Cadastro de Usuário')

@section('content_header')
    <h1>Cadastro de Usuário</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-black">
            <div class="box-header with-border">
                <h3 class="box-title">Dados do Usuário</h3>
            </div>
            <!-- /.box-header -->
            <form action="{{ route('usuarios.store') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Nome Completo</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                            placeholder="Digite o nome completo do usuário" required>
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
                            placeholder="Digite o e-mail do usuário" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="password" class="form-control"
                               placeholder="Digite uma senha para o usuário" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        <label for="password_confirmation">Confirmação da Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                               placeholder="Confirme a senha" required>
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
                            <a href="{{ route('usuarios.index') }}" class="btn btn-flat btn-danger pull-left" title="Cancelar">Cancelar</a>
                            <button type="submit" class="btn btn-flat btn-primary pull-right" title="Salvar Usuário">Salvar Usuário</button>
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