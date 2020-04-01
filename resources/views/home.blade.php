@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Home</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-black">
            <div class="box-header with-border">
                @can('admin')
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <a href="{{ route('usuarios.index') }}" title="Gerenciar Usuários">                           
                            <div class="small-box bg-black">
                                <div class="inner">
                                    <h3>Gerenciar</h3>
                                    <p>Usuários</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <span class="small-box-footer">Gerenciar <i class="fa fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('view-edit-delete-phone')
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <a href="{{ route('telefones.index') }}" title="Gerenciar Telefones">                           
                            <div class="small-box bg-black">
                                <div class="inner">
                                    <h3>Gerenciar</h3>
                                    <p>Telefones</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-phone-portrait"></i>
                                </div>
                                <span class="small-box-footer">Gerenciar <i class="fa fa-arrow-circle-right"></i></span>
                            </div>
                        </a>
                    </div>
                @endcan
                <div class="col-xs-12 col-sm-6 col-lg-4">
                    <a href="{{ route('logs.index') }}" title="Visualizar Log de Atividades">                           
                        <div class="small-box bg-black">
                            <div class="inner">
                                <h3>Visualizar</h3>
                                <p>Log de Atividades</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-archive"></i>
                            </div>
                            <span class="small-box-footer">Visualizar <i class="fa fa-arrow-circle-right"></i></span>
                        </div>
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            @can('view-phone')
                <div class="box-body">
                    <form id="search-form" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" id="search" name="search" placeholder="Digite o nome, e-mail ou telefone do cliente que deseja pesquisar" class="form-control">
                            <div class="input-group-btn">
                                <button type="submit" class="btn bg-black btn-flat">Pesquisar Cliente</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-xs-12">
                            <ul id="results" class="products-list product-list-in-box" style="padding: 10px;">
                                
                                <!-- Search Results -->

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            @endcan
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
@can('view-phone')
    <script src="{{ asset('vendor/adminlte/vendor/jquery-form/dist/jquery.form.min.js') }}"></script>
    <script>
        $(function() {
            $('#search-form').submit(function(event) {
                event.preventDefault();
                var searchText = $('#search').val();
                if(searchText === "")
                    $('#results').children('li').remove();
                else
                    $.ajax({
                        url: "{{ route('telefones.search') }}",
                        type: "post",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            $('#results').children('li').remove();
                            var phones = response.phones;
                            if(phones.length > 0 ) {
                                phones.forEach(phone => {
                                    var item = '<li class="item" style="padding-top: 5px; padding-bottom: 5px;">' +
                                                    '<span style="font-size: 18px;">' + phone.client_name + '</span>' +
                                                    '<a href="mailto:'+phone.client_email+'" title="Enviar E-mail" style="margin-left: 5px; margin-right: 5px;"><i class="fa fa-lg fa-envelope text-black"></i></a>' +
                                                    phone.links +
                                                    '<span class="product-description">' +
                                                        phone.number + '<br>' +
                                                        phone.client_email +
                                                    '</span>' +
                                                '</li>';
                                    $('#results').append(item);
                                });
                            } else {
                                var item = '<li class="item" style="padding-top: 5px; padding-bottom: 5px; text-align: center;">' +
                                                '<h3>Nenhum cliente encontrado!</h3>' +
                                        '</li>';
                                $('#results').append(item);
                            }
                        }
                    });
            });
        });
    </script>
@endcan
@stop