<?php

namespace Modules\User\Services;

use Modules\User\Criteria\UserTransactionCriteria;
use Prettus\Repository\Exceptions\RepositoryException;

class UsersIndexService extends BaseService
{
    /**
     * @throws RepositoryException
     */
    public function execute()
    {
        return $this->userRepository->pushCriteria(UserTransactionCriteria::class)
            ->cursorPaginate(request()->getPaginationCount())
            ->appends(request()->query());
    }
}
