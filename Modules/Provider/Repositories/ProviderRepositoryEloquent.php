<?php

namespace Modules\Provider\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Modules\Provider\Criteria\RequestCriteria;
use Modules\Provider\Repositories\ProviderRepository;
use Modules\Provider\Models\Provider;
use Modules\Provider\Validators\ProviderValidator;

/**
 * Class ProviderRepositoryEloquent.
 *
 * @package namespace Modules\Provider\Repositories;
 */
class ProviderRepositoryEloquent extends BaseRepository implements ProviderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Provider::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
