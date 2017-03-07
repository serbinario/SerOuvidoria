@extends('menu')

@section('content')
    <section id="content">
        <div class="container">
            <div class="block-header">
                <h2>Listar Subassunto(s)</h2>
            </div>

            <div class="card material-table">
                <div class="card-header">
                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <em> {!! session('message') !!}</em>
                        </div>
                    @endif

                    @if(Session::has('errors'))
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                @endif

                <!-- Botão novo -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right">
                                <a class="btn btn-primary btn-sm m-t-10", href="{{ route('seracademico.ouvidoria.subassunto.create')}}">Novo Subassunto</a>
                            </div>
                        </div>
                    </div>
                    <!-- Botão novo -->
                </div>

                <div class="table-responsive">
                    <table id="subassunto-grid" class="table table-hover" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Secretaria</th>
                            <th>Assunto</th>
                            <th>Nome</th>
                            <th>Acão</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Secretaria</th>
                            <th>Assunto</th>
                            <th>Nome</th>
                            <th style="width: 16%;">Acão</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </section>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){

            var table = $('#subassunto-grid').DataTable({
                processing: true,
                serverSide: true,
                order: [[ 1, "asc" ]],
                ajax: {
                    url: "{!! route('seracademico.ouvidoria.subassunto.grid') !!}",
                    method: 'POST'
                },
                columns: [
                    {data: 'area', name: 'ouv_area.nome'},
                    {data: 'assunto', name: 'ouv_assunto.nome'},
                    {data: 'nome', name: 'ouv_subassunto.nome'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });


        $(document).on('click', 'a.excluir', function (event) {
            event.preventDefault();
            var url = $(this).attr('href');
            bootbox.confirm("Tem certeza da exclusão do item?", function (result) {
                if (result) {
                    location.href = url
                } else {
                    false;
                }
            });
        });
    </script>
@stop