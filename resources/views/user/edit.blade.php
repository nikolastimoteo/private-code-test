@extends('adminlte::page')

@section('title', 'Edição de Usuário')

@section('content_header')
    <h1>Edição de Usuário</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-black">
            <div class="box-header with-border">
                <h3 class="box-title">Dados do Usuário</h3>
            </div>
            <!-- /.box-header -->
            <form action="{{ route('usuarios.update', ['id' => $user->id]) }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                @method('PUT')
                <div class="box-body">
                    <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Nome Completo</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}"
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
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}"
                            placeholder="Digite o e-mail do usuário" required readonly>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group has-feedback {{ $errors->has('groups') ? 'has-error' : '' }}">
                        <label for="groups">Grupos</label>
                        <select id="groups" name="groups[]" multiple="multiple"class="form-control select2" style="width: 100%;">
                            <option value="" disabled>Selecione os grupos...</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" @if($user->hasRole($group)) selected @endif>{{ $group->display_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('groups'))
                            <span class="help-block">
                                <strong>{{ $errors->first('groups') }}</strong>
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
<script>
    $(function () {
        $(".select2").select2();
    });
</script>
@stop