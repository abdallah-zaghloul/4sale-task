<?php

namespace Modules\User\Services;


use Modules\User\Repositories\UserRepository;

class BaseService
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }
}
