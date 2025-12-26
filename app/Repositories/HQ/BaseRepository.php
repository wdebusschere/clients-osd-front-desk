<?php

namespace App\Repositories\HQ;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use RuntimeException;

abstract class BaseRepository
{
    protected string $uri;
    protected string $baseUri;
    protected Client $httpClient;

    public function __construct()
    {
        $this->baseUri = config('services.osd-hq.host').'/';

        $config = [
            'base_uri' => $this->baseUri,
            'headers' => [
                'Authorization' => 'Bearer '.$this->getAccessToken(),
                'Accept' => 'application/json',
            ],
        ];

        $this->httpClient = new Client($config);
    }

    /**
     * Get access token.
     */
    public function getAccessToken(): string
    {
        try {
            $uri = sprintf('%s%s', $this->baseUri, 'oauth/token');

            $response = Http::asForm()->post($uri, [
                'grant_type' => 'client_credentials',
                'client_id' => config('services.osd-hq.client_id'),
                'client_secret' => config('services.osd-hq.client_secret'),
                'scope' => '*',
            ]);

            // Check if the request was successful
            if (! $response->successful()) {
                throw new RequestException($response);
            }

            $data = $response->json();

            // Validate response structure
            if (! isset($data['access_token'])) {
                throw new RuntimeException(
                    'Invalid response format: access_token not found in response'
                );
            }

            if (empty($data['access_token'])) {
                throw new RuntimeException(
                    'Invalid response: access_token is empty'
                );
            }

            return $data['access_token'];
        } catch (ConnectionException $e) {
            // Network/connection issues
            throw new RuntimeException(
                'Unable to connect to OAuth server: '.$e->getMessage(),
                0,
                $e
            );
        } catch (RequestException $e) {
            // HTTP errors (4xx, 5xx) - RequestException already contains the response details
            throw new RuntimeException(
                'OAuth request failed: '.$e->getMessage(),
                0,
                $e
            );
        } catch (Exception $e) {
            // Any other unexpected errors
            throw new RuntimeException(
                'Unexpected error getting access token: '.$e->getMessage(),
                0,
                $e
            );
        }
    }

    public function all(array $params = []): Collection
    {
        $options = [
            'query' => $params,
        ];

        try {
            $request = $this->httpClient->request('GET', $this->uri, $options);
        } catch (\Exception $e) {
            throw $e;
        }

        // Decode and build a collection out of the response.
        return collect(json_decode((string) $request->getBody()));
    }

    public function show(int $id, array $params = []): mixed
    {
        $options = [
            'query' => $params,
        ];

        $uri = sprintf('%s/%s', $this->uri, $id);

        try {
            $request = $this->httpClient->request('GET', $uri, $options);
        } catch (\Exception $e) {
            throw $e;
        }

        return json_decode($request->getBody()->getContents());
    }

    public function store(array $data): mixed
    {
        $options = [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'multipart' => $data,
        ];

        try {
            $request = $this->httpClient->request('POST', $this->uri, $options);
        } catch (\Exception $e) {
            throw $e;
        }

        return json_decode($request->getBody()->getContents());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $uri = sprintf('%s/%s', $this->uri, $id);

        try {
            $request = $this->httpClient->request('DELETE', $uri);
        } catch (\Exception $e) {
            throw $e;
        }

        return json_decode($request->getBody()->getContents());
    }
}
