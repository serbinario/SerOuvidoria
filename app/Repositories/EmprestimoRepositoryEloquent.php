<?php

namespace Seracademico\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Seracademico\Validators\EmprestimoValidator;
use Seracademico\Repositories\EmprestimoRepository;
use Seracademico\Entities\Emprestimo;

/**
 * Class EmprestimoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class EmprestimoRepositoryEloquent extends BaseRepository implements EmprestimoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Emprestimo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

         return EmprestimoValidator::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
