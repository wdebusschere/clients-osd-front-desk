<?php

namespace App\Repositories\HQ;

class DepartmentRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();

        $this->uri = 'api/departments';
    }
}
