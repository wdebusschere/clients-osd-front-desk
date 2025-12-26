<?php

namespace App\Repositories\HQ;

class ClientApplicationRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();

        $this->uri = 'api/client-applications';
    }

    public function users(): array
    {
        $uri = sprintf('%s/%s/users', $this->uri, config('services.osd-hq.client_id'));

        $response = $this->httpClient->request('GET', $uri);

        return (array) json_decode((string) $response->getBody(), true);
    }
}
