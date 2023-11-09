<?php

namespace Modules\Provider\Criteria;

use Prettus\Repository\Criteria\RequestCriteria as BaseCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RequestCriteria.
 *
 * @package namespace Modules\Provider\QueryCheck;
 */
class RequestCriteria extends BaseCriteria
{
    /**
     * Apply criteria in query repository
     *
     * @param mixed              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return parent::apply($model, $repository);
    }
}
