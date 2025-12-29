<?php

namespace App\Services\HQ;

use App\Repositories\UserRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class UsersImporter
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UsersImporter constructor.
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * Import users from HQ's API.
     */
    public function import(): array
    {
        $errors = [];

        $http = new Client();

        // Request token
        $requestTokenResponse = $http->post(config('services.osd-hq.host').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => config('services.osd-hq.client_id'),
                'client_secret' => config('services.osd-hq.client_secret'),
                'scope' => '',
            ],
        ]);

        $accessToken = json_decode((string) $requestTokenResponse->getBody(), true)['access_token'];

        // Request users
        $requestUsersResponse = $http->get(config('services.osd-hq.host').'/api/client-applications/'.config('services.osd-hq.client_id').'/users', [
            'headers' => [
                'Authorization' => 'Bearer '.$accessToken,
                'Accept' => 'application/json',
            ],
        ]);

        $hqUsers = json_decode((string) $requestUsersResponse->getBody(), true);

        foreach ($hqUsers as $hqUser) {
            try {
                $this->userRepository->findByHQIdOrCreate($hqUser);
            } catch (\Exception $exception) {
                $data = [
                    'data' => $hqUser,
                    'error' => $exception->getMessage(),
                ];

                Log::error('An error occurred while trying to import user', $data);

                $errors[] = $data;
            }
        }

        return $errors;
    }
}
