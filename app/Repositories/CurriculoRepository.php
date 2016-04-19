<?php

namespace Seracademico\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CurriculoRepository
 * @package namespace App\Repositories;
 */
interface CurriculoRepository extends RepositoryInterface
{
    public abstract function getCurriculoAtivo($cursoId);
}
