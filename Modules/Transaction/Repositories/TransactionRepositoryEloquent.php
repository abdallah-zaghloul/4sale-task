<?php

namespace Modules\Transaction\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Modules\Transaction\Criteria\RequestCriteria;
use Modules\Transaction\Repositories\TransactionRepository;
use Modules\Transaction\Models\Transaction;
use Modules\Transaction\Validators\TransactionValidator;

/**
 * Class TransactionRepositoryEloquent.
 *
 * @package namespace Modules\Transaction\Repositories;
 */
class TransactionRepositoryEloquent extends BaseRepository implements TransactionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Transaction::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
