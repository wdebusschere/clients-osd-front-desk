<?php

namespace App\Repositories\HQ;

class TypeRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();

        $this->uri = 'api/types';
    }
}
