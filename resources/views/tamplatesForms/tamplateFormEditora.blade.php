<div class="row">
	<div class="col-md-12">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#dados" aria-controls="dados" role="tab" data-toggle="tab">Principais dados</a></li>
            <li role="presentation"><a href="#endereco" aria-controls="endereco" role="tab" data-toggle="tab">Endereço</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="dados">
                <br />
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">

                            {!! Form::label('nome', 'Nome') !!}
                            {!! Form::text('nome', Session::getOldInput('nome')  , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('email', 'E-mail') !!}
                            {!! Form::text('email', Session::getOldInput('email')  , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('site', 'Site') !!}
                            {!! Form::text('site', Session::getOldInput('site')  , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('cnpj', 'CNPJ') !!}
                            {!! Form::text('cnpj', Session::getOldInput('cnpj')  , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('razao_social', 'Razão Social') !!}
                            {!! Form::text('razao_social', Session::getOldInput('razao_social')  , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('agencia', 'Agência') !!}
                            {!! Form::text('agencia', Session::getOldInput('agencia')  , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('conta', 'Conta') !!}
                            {!! Form::text('conta', Session::getOldInput('conta')  , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="endereco">
                <br />
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('endereco[logradouro]', 'Endereço') !!}
                            {!! Form::text('endereco[logradouro]', Session::getOldInput('endereco[logradouro]')  , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('endereco[numero]', 'Número') !!}
                            {!! Form::text('endereco[numero]', Session::getOldInput('endereco[numero]')  , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('endereco[complemento]', 'Complemento') !!}
                            {!! Form::text('endereco[complemento]', Session::getOldInput('endereco[complemento]')  , array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        {!! Form::label('estado', 'UF ') !!}
                        @if(isset($model->endereco->bairro->cidade->estado->id))
                            {!! Form::select('estado', $loadFields['estado'], $model->endereco->bairro->cidade->estado->id, array('class' => 'form-control', 'id' => 'estado')) !!}
                        @else
                            {!! Form::select('estado', $loadFields['estado'], Session::getOldInput('estado'), array('class' => 'form-control', 'id' => 'estado')) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        {!! Form::label('cidade', 'Cidade ') !!}
                        @if(isset($model->endereco->bairro->cidade->id))
                            {!! Form::select('cidade', array($model->endereco->bairro->cidade->id => $model->endereco->bairro->cidade->nome), $model->endereco->bairro->cidade->id,array('class' => 'form-control', 'id' => 'cidade')) !!}
                        @else
                            {!! Form::select('cidade', array(), Session::getOldInput('cidade'),array('class' => 'form-control', 'id' => 'cidade')) !!}
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        {!! Form::label('endereco[bairros_id]', 'Bairro ') !!}
                        @if(isset($model->endereco->bairro->id))
                            {!! Form::select('endereco[bairros_id]', array($model->endereco->bairro->id => $model->endereco->bairro->nome), $model->endereco->bairro->id,array('class' => 'form-control', 'id' => 'bairro')) !!}
                        @else
                            {!! Form::select('endereco[bairros_id]', array(), Session::getOldInput('bairro'),array('class' => 'form-control', 'id' => 'bairro')) !!}
                        @endif
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('endereco[cep]', 'CEP') !!}
                            {!! Form::text('endereco[cep]', Session::getOldInput('endereco[cep]')  , array('class' => 'form-control')) !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
	</div>
    <div class="col-md-12">
        {!! Form::submit('Salvar', array('class' => 'btn btn-primary', 'id' => 'submitForm')) !!}
    </div>
</div>