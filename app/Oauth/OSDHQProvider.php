<?php

namespace App\Oauth;

use GuzzleHttp\RequestOptions;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class OSDHQProvider extends AbstractProvider implements ProviderInterface
{
    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase(config('services.osd-hq.url').'/oauth/authorize', $state);
    }

    protected function getTokenUrl(): string
    {
        return config('services.osd-hq.host').'/oauth/token';
    }

    protected function getUserByToken($token): array
    {
        $uri = config('services.osd-hq.host').'/api/user';

        $options = [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer '.$token,
            ],
        ];

        $response = $this->getHttpClient()->get($uri, $options);

        return (array) json_decode((string) $response->getBody(), true);
    }

    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'avatar' => $user['avatar'],
            'oauth_clients' => $user['oauth_clients'],
            'active' => $user['active'],
            'created_at' => $user['created_at'],
            'updated_at' => $user['updated_at'],
            'roles' => $user['roles'],
        ]);
    }
}
