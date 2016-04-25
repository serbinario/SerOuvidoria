<?php

namespace Seracademico\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Seracademico\Validators\GeneroValidator;
use Seracademico\Repositories\GeneroRepository;
use Seracademico\Entities\Genero;

/**
 * Class GeneroRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GeneroRepositoryEloquent extends BaseRepository implements GeneroRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Genero::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

         return GeneroValidator::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
