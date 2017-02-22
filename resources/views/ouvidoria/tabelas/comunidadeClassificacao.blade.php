@extends('menu')

@section('css')
    <style type="text/css" class="init">

        body {
            font-family: arial;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table , tr , td {
            font-size: small;
        }
    </style>
@endsection

@section('content')
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="col-sm-6 col-md-9">
                <h4><i class="material-icons">find_in_page</i> TABELA DE COMUNIDADE POR CLASSIFICAÇÃO</h4>
            </div>
            <div class="col-sm-6 col-md-3">
                {{--<a href="{{ route('seracademico.ouvidoria.graficos.assunto') }}" target="_blank" class="btn-sm btn-primary pull-right">Imprimir</a>--}}
            </div>
        </div>

        <div class="ibox-content">

            <div class="row">
                <div class="col-12-md">
                    {!! Form::open(['method' => "POST", 'route'=>'seracademico.ouvidoria.tabelas.comunidadeClassificacao',]) !!}
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('secretaria', 'Secretaria *') !!}
                                {!! Form::select('secretaria',$loadFields['ouvidoria\secretaria']->toArray(), Session::getOldInput('secretaria'), array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $data = new \DateTime('now') ?>
                                <?php $dataInicio =  isset($request['data_inicio']) ? $request['data_inicio'] : ""; ?>
                                {!! Form::label('data_inicio', 'Início') !!}
                                {!! Form::text('data_inicio', $dataInicio , array('class' => 'form-control date datepicker')) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php $dataFinal =  isset($request['data_fim']) ? $request['data_fim'] : ""; ?>
                                {!! Form::label('data_fim', 'Fim') !!}
                                {!! Form::text('data_fim', $dataFinal , array('class' => 'form-control date datepicker')) !!}
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" style="margin-top: 22px" id="search" class="btn-primary btn input-sm">
                                Consultar
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-12-md">
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="1"></th>
                            <th colspan="6" style="text-align: center;background-color: #e7ebe9">Classificação</th>
                        </tr>
                        <tr style="background-color: #f1f3f2">
                            <th>Comunidade</th>
                            <th>Denúncia</th>
                            <th>Elogio</th>
                            <th>Informação</th>
                            <th>Reclamação</th>
                            <th>Solicitação</th>
                            <th>Sugestão</th>
                            <th>Total Geral</th>
                            <th>%</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($array as $item)
                            <tr>
                                <td>{{$item['comunidade']}}</td>
                                <td>
                                    @if(isset($item['Denúncia']))
                                        {{$item['Denúncia']}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item['Elogio']))
                                        {{$item['Elogio']}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item['Informação']))
                                        {{$item['Informação']}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item['Reclamação']))
                                        {{$item['Reclamação']}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item['Solicitação']))
                                        {{$item['Solicitação']}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item['Sugestão']))
                                        {{$item['Sugestão']}}
                                    @endif
                                </td>
                                <td>
                                    {{$item['totalGeral']}}
                                </td>
                                <td>
                                    <?php
                                    $valor = $item['totalGeral'] / $totalDemandas;
                                    $porcentagem = $valor * 100;
                                    echo number_format($porcentagem, 2, ',', '.') . "%";
                                    ?>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr style="background-color: #f1f3f2">
                            <th></th>
                            <th>
                                <?php
                                $denuncia = 0;
                                foreach ($array as $i) {
                                    if(isset($i['Denúncia'])) {
                                        $denuncia += $i['Denúncia'];
                                    }
                                }
                                echo $denuncia;
                                ?>
                            </th>
                            <th>
                                <?php
                                $elogio = 0;
                                foreach ($array as $i) {
                                    if(isset($i['Elogio'])) {
                                        $elogio += $i['Elogio'];
                                    }
                                }
                                echo $elogio;
                                ?>
                            </th>
                            <th>
                                <?php
                                $informacao = 0;
                                foreach ($array as $i) {
                                    if(isset($i['Informação'])) {
                                        $informacao += $i['Informação'];
                                    }
                                }
                                echo $informacao;
                                ?>
                            </th>
                            <th>
                                <?php
                                $reclamacao = 0;
                                foreach ($array as $i) {
                                    if(isset($i['Reclamação'])) {
                                        $reclamacao += $i['Reclamação'];
                                    }
                                }
                                echo $reclamacao;
                                ?>
                            </th>
                            <th>
                                <?php
                                $solicitacao = 0;
                                foreach ($array as $i) {
                                    if(isset($i['Solicitação'])) {
                                        $solicitacao += $i['Solicitação'];
                                    }
                                }
                                echo $solicitacao;
                                ?>
                            </th>
                            <th>
                                <?php
                                $sugestao = 0;
                                foreach ($array as $i) {
                                    if(isset($i['Sugestão'])) {
                                        $sugestao += $i['Sugestão'];
                                    }
                                }
                                echo $sugestao;
                                ?>
                            </th>
                            <th>
                                {{$totalDemandas}}
                            </th>
                            <th>
                                100%
                            </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
@stop