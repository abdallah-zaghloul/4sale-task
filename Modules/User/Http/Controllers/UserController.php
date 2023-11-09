<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Services\UsersIndexService;
use Modules\User\Traits\Response;
use Prettus\Repository\Exceptions\RepositoryException;

class UserController extends Controller
{
    use Response;

    /**
     * @param UsersIndexService $service
     * @return JsonResponse
     * @throws RepositoryException
     */
    public function index(UsersIndexService $service): JsonResponse
    {
        $users = $service->execute();
        return $this->dataResponse(data: compact('users'));
    }
}
