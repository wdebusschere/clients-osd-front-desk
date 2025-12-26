<?php

namespace App\Repositories\HQ;

class ClientRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();

        $this->uri = 'api/clients';
    }
}
