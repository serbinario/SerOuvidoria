<!DOCTYPE html>

<html class="ie9">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('/lib/chosen/chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('/lib/summernote/dist/summernote.css') }}" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="{{ asset('/dist/css/app_1.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('/dist/css/app_2.min.css') }}"  media="screen,projection"/>

    {{-- CSS personalizados--}}
    <link type="text/css" rel="stylesheet" href="{{ asset('/dist/css/demo.css') }}"  media="screen,projection"/>
    <link href="{{ asset('/css/bootstrapValidation.mim.css')}}" rel="stylesheet">
    <link href="{{ asset('/css/jquery.datetimepicker.css')}}" rel="stylesheet"/>
</head>
<body>
<div class="conteiner">
    <div class="row">
        <center>
            <div class="topo" style="background-color: #213a53">
                <center>
                    <img src="{{asset('/img/LOGO_OUVIDORIA_2.jpg')}}" style="width: 500px; height: 150px">
                    {{--<img src="{{asset('/img/igarassu.png')}}" style="width: 400px; height: 90px">--}}
                </center>
            </div>
        </center>
    </div>
    <br />
    <center><h2><?php echo "REGISTRO DE MANIFESTAÇÃO DA OUVIDORIA"; ?></h2></center>

    <br />
    <div class="row">
        <div class="col-md-9 col-md-offset-2">
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
            {!! Form::open(['route'=>'storePublico', 'method' => "POST", 'id'=> 'formDemanda' ]) !!}
            @include('tamplatesForms.tamplateFormDemandaPublic')
            {!! Form::close() !!}
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<script src="{{ asset('/js/jquery-2.1.1.js')}}"></script>
<script src="{{ asset('/js/jquery-ui.js')}}"></script>
<script src="{{ asset('/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('/js/jquery.mask.js')}}"></script>
<script src="{{ asset('/js/mascaras.js')}}"></script>
<script src="{{ asset('/js/bootstrapvalidator.js')}}" type="text/javascript"></script>
<script src="{{ asset('/js/jquery.datetimepicker.js')}}" type="text/javascript"></script>
<script src="{{ asset('/js/validacoes/validation_form_demanda_publico.js')}}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>
<script type="text/javascript">

    $("#formDemanda").validate({
        submitHandler: function (form) {
            var response = grecaptcha.getResponse();
            //recaptcha failed validation
            if (response.length == 0) {
                $('#recaptcha-error').show();
                return false;
            }
            //recaptcha passed validation
            else {
                $('#recaptcha-error').hide();
                return true;
            }
        }
    });

    $(document).ready(function(){
        $('#msg-sigilo').hide();

        // Exibi a mensagem de informação para caso da opção de "Deseja sigilo" esta marcada
        $('#sigilo-2, #sigilo-1').on('click', function(){
            if($("#sigilo-2").prop( "checked")) {
                $('#msg-sigilo').show();
            } else if ($("#sigilo-1").prop( "checked")) {
                $('#msg-sigilo').hide();
            }
        });

    });

    //Carregando os bairros
    $(document).on('change', "#cidade", function () {
        //Removendo as Bairros
        $('#bairro option').remove();

        //Recuperando a cidade
        var cidade = $(this).val();

        if (cidade !== "") {
            var dados = {
                'table' : 'bairros',
                'field_search' : 'cidades_id',
                'value_search': cidade,
            }

            jQuery.ajax({
                type: 'POST',
                url: '{{ route('seracademico.util.search')  }}',
                headers: {
                    'X-CSRF-TOKEN': '{{  csrf_token() }}'
                },
                data: dados,
                datatype: 'json'
            }).done(function (json) {
                var option = "";

                option += '<option value="">Selecione um bairro</option>';
                for (var i = 0; i < json.length; i++) {
                    option += '<option value="' + json[i]['id'] + '">' + json[i]['nome'] + '</option>';
                }

                $('#bairro option').remove();
                $('#bairro').append(option);
            });
        }
    });

</script>

</body>
</html>
