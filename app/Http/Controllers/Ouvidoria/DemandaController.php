<?php

namespace Seracademico\Http\Controllers\Ouvidoria;

use Illuminate\Http\Request;

use Seracademico\Http\Controllers\Controller;
use Seracademico\Http\Requests;
use Seracademico\Services\Ouvidoria\DemandaService;
use Yajra\Datatables\Datatables;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Seracademico\Validators\DemandaValidator;

class DemandaController extends Controller
{
    /**
    * @var DemandaService
    */
    private $service;

    /**
    * @var DemandaValidator
    */
    private $validator;

    /**
    * @var array
    */
    private $loadFields = [
        'Ouvidoria\Area',
        'Ouvidoria\Anonimo',
        'Ouvidoria\Escolaridade',
        'Ouvidoria\Idade',
        'Ouvidoria\Informacao',
        'Ouvidoria\Sigilo',
        'Ouvidoria\TipoDemanda',
        'Ouvidoria\ExclusividadeSUS',
        'Sexo',
    ];

    /**
    * @param DemandaService $service
    * @param DemandaValidator $validator
    */
    public function __construct(DemandaService $service, DemandaValidator $validator)
    {
        $this->service   =  $service;
        $this->validator =  $validator;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('ouvidoria.demanda.index');
    }

    /**
     * @return mixed
     */
    public function grid()
    {
        #Criando a consulta
        $rows = \DB::table('ouv_demanda')
            ->leftJoin('ouv_informacao', 'ouv_informacao.id', '=', 'ouv_demanda.informacao_id')
            ->leftJoin('ouv_idade', 'ouv_idade.id', '=', 'ouv_demanda.idade_id')
            ->leftJoin('ouv_tipo_demanda', 'ouv_tipo_demanda.id', '=', 'ouv_demanda.tipo_demanda_id')
            ->leftJoin('ouv_exclusividade_sus', 'ouv_exclusividade_sus.id', '=', 'ouv_demanda.exclusividade_sus_id')
            ->select('ouv_demanda.id',
                'ouv_demanda.nome',
                'ouv_informacao.nome as informacao',
                'ouv_idade.nome as idade',
                'ouv_tipo_demanda.nome as tipo_demanda',
                'ouv_exclusividade_sus.nome as exclusividade',
                'ouv_demanda.relato',
                \DB::raw('CONCAT (SUBSTRING(ouv_demanda.codigo, 4, 4), "/", SUBSTRING(ouv_demanda.codigo, -4, 4)) as codigo')
            );

        #Editando a grid
        return Datatables::of($rows)->addColumn('action', function ($row) {

            $html = '<a href="edit/'.$row->id.'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Editar</a> ';
            $html .= '<a href="registro/'.$row->id.'" class="btn btn-xs btn-success" target="__blanck"><i class="fa fa-edit"></i> Registro</a>';

            return $html;
        })->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('ouvidoria.demanda.create', compact('loadFields'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createPublic()
    {
        #Carregando os dados para o cadastro
        $loadFields = $this->service->load($this->loadFields);

        #Retorno para view
        return view('ouvidoria.demanda.createPublic', compact('loadFields'));
    }

    /**
     * @param Request $request
     * @return $this|array|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            #Recuperando os dados da requisição
            $data = $request->all();

            #tratando as rules

            #Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            #Executando a ação
            $this->service->store($data);

            #Retorno para a view
            return redirect()->back()->with("message", "Cadastro realizado com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        } catch (\Throwable $e) {print_r($e->getMessage()); exit;
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return $this|array|\Illuminate\Http\RedirectResponse
     */
    public function storePublic(Request $request)
    {
        try {
            #Recuperando os dados da requisição
            $data = $request->all();

            #tratando as rules

            #Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            #Executando a ação
            $this->service->store($data);

            #Retorno para a view
            return redirect()->back()->with("message", "Cadastro realizado com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        } catch (\Throwable $e) {print_r($e->getMessage()); exit;
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            #Recuperando a empresa
            $model = $this->service->find($id);

            #Carregando os dados para o cadastro
            $loadFields = $this->service->load($this->loadFields);

            #retorno para view
            return view('ouvidoria.demanda.edit', compact('model', 'loadFields'));
        } catch (\Throwable $e) {dd($e);
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            #Recuperando os dados da requisição
            $data = $request->all();

            #tratando as rules
            $this->validator->replaceRules(ValidatorInterface::RULE_UPDATE, ":id", $id);

            #Validando a requisição
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            #Executando a ação
            $this->service->update($data, $id);

            #Retorno para a view
            return redirect()->back()->with("message", "Alteração realizada com sucesso!");
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        } catch (\Throwable $e) { dd($e);
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registro(Request $request, $id)
    {
        $demanda = $this->service->find($id);

        return \PDF::loadView('reports.registroDemanda', ['demanda' =>  $demanda])->stream();
    }

}