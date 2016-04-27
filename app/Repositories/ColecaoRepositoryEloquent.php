<?php

namespace Seracademico\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Seracademico\Validators\ColecaoValidator;
use Seracademico\Repositories\ColecaoRepository;
use Seracademico\Entities\Colecao;

/**
 * Class ColecaoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ColecaoRepositoryEloquent extends BaseRepository implements ColecaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Colecao::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

         return ColecaoValidator::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}