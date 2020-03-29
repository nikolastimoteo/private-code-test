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
                <h3 class="box-title">Dados do Meu Perfil</h3>
                <a href="{{ route('getChangePassword') }}" class="btn btn-flat btn-warning btn-sm pull-right" title="Alterar Senha">Alterar Senha</a>
            </div>
            <!-- /.box-header -->
            <form action="{{ route('postProfile') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                        <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}"
                            placeholder="Nome Completo" required>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}"
                            placeholder="E-mail" required readonly>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="{{ route('getHome') }}" class="btn btn-flat btn-default pull-left" title="Voltar">Voltar</a>
                            <button type="submit" class="btn btn-flat btn-success pull-right" title="Salvar Alterações">Salvar Alterações</button>
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