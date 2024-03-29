<?php

namespace Seracademico\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class EncaminhamentoValidator extends LaravelValidator
{
	use TraitReplaceRulesValidator;

	protected $messages  = [
		'required' => ':attribute � requerido',
	];

	protected $attributes = [
		'secretaria' =>  'Secretaria' ,
		'parecer' =>  'Parecer' ,
		'destinatario_id' =>  'Destino' ,
		'prioridade_id' =>  'Prioridade' ,
	];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [

			'secretaria' =>  'required' ,
			'parecer' =>  'required' ,
			'destinatario_id' =>  'required' ,
			'prioridade_id' =>  'required' ,

        ],
        ValidatorInterface::RULE_UPDATE => [

			'secretaria' =>  'required' ,
			'parecer' =>  'required' ,
			'destinatario_id' =>  'required' ,
			'prioridade_id' =>  'required' ,

        ],
   ];

}
