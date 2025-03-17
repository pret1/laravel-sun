<?php

namespace App\HttpClients;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PostHttpClient
{
    const DOMAIN = 'http://172.17.0.1:8080';
    private static string $token = '';

    public static function make(): PostHttpClient
    {
        return new self();
    }

    public function index(): array|Collection
    {
        try {
            $response = Http::withToken(self::$token)
                ->withQueryParameters([
                    "likesdsfsfd_tofsdfsdfdsf" => 2,
//                "likes_to" => 2,
//                "content" => "nisi",
                    // "tag_title" => "at",
//                "published_at_to" => "2008-08-09",
                ])
                ->withHeaders(['Accept' => 'application/json'])
                ->get(self::DOMAIN . '/api/posts');
            return $this->handleResponse($response);
        } catch (\Exception $e) {
            return $this->logError('index', $e);
        }
    }

    public function show(int $id): array|Collection
    {
        try {
            $response = Http::withToken(self::$token)
                ->withHeaders(['Accept' => 'application/json'])
                ->get(self::DOMAIN . "/api/posts/$id");
            return $this->handleResponse($response);
        } catch (\Exception $e) {
            return $this->logError('show', $e, ['id' => $id]);
        }
    }

    public function store(array $data): array|Collection
    {
        try {
//            $response = Http::post("https://httpstat.us/422");
            $response = Http::withToken(self::$token)
                ->withHeaders(['Accept' => 'application/json'])
                ->post(self::DOMAIN . "/api/posts", $data);

            return $this->handleResponse($response);
        } catch (\Exception $e) {
            return $this->logError('store', $e, ['data' => $data]);
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $response = Http::withToken(self::$token)
                ->withHeaders(['Accept' => 'application/json'])
                ->patch(self::DOMAIN . "/api/posts/$id", $data);
            return $this->handleResponse($response);
        } catch (\Exception $e) {
            return $this->logError('update', $e, ['id' => $id, 'data' => $data]);
        }

    }

    public function delete(int $id)
    {
        try {
            $response = Http::withToken(self::$token)
                ->withHeaders(['Accept' => 'application/json'])
                ->delete(self::DOMAIN . "/api/posts/$id");
            return $this->handleResponse($response);
        } catch (\Exception $e) {
            return $this->logError('delete', $e, ['id' => $id]);
        }
    }

    public function login(): array|self
    {
        try {
            if (Cache::has('jwt_token')) {
                self::$token = Cache::get('jwt_token');
                return $this;
            }

            $response = Http::post(self::DOMAIN . '/api/auth/login', [
                "email" => config('sun.email'),
                "password" => config('sun.password')
            ]);

            $response = $this->handleResponse($response);
            if ($response instanceof Collection){
                self::$token = $response['access_token'];
                cache(['jwt_token' => self::$token], now()->addMinutes(60));
            } else {
                throw new \Exception('Login failed');
            }

            return $this;
        } catch (\Exception $e) {
            return $this->logError('login', $e);
        }

    }

    private function handleResponse(Response $response): Collection|array
    {
        if ($response->successful()) {
            return $response->collect();
        }

        $error = [
            'status' => $response->status(),
            'body' => $response->body(),
        ];
        Log::channel('http_clients')->error('HTTP Request Failed', $error);

        return ['error' => 'Request failed', 'details' => $error];
    }

    private function logError(string $method, \Exception $e, array $context = []): array
    {
        Log::channel('http_clients')->error("Error in method: $method", [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'context' => $context
        ]);

        return ['error' => "An error occurred in $method", 'message' => $e->getMessage()];
    }
}
