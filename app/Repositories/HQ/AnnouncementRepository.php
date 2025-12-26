<?php

namespace App\Repositories\HQ;

class AnnouncementRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();

        $this->uri = 'api/announcements';
    }
}
