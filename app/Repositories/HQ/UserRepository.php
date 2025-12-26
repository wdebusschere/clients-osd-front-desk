<?php

namespace App\Repositories\HQ;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();

        $this->uri = 'api/users';
    }
}
