<?php

namespace Seracademico\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Seracademico\Validators\ArcevoValidator;
use Seracademico\Repositories\ArcevoRepository;
use Seracademico\Entities\Arcevo;

/**
 * Class ArcevoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ArcevoRepositoryEloquent extends BaseRepository implements ArcevoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Arcevo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

         return ArcevoValidator::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
