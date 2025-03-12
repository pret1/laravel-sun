<?php

namespace App\HttpClients;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class PostHttpClient
{
    const DOMAIN = 'http://172.17.0.1:8080';
    private static string $token = '';

    public static function make(): PostHttpClient
    {
        return new self();
    }

    public function index(): Collection
    {
        return Http::withToken(self::$token)->get(self::DOMAIN . '/api/posts')->collect();
    }

    public function show(int $id): Collection
    {
        return Http::withToken(self::$token)->get(self::DOMAIN . "/api/posts/$id")->collect();
    }

    public function store(array $data)
    {
        Http::withToken(self::$token)->post(self::DOMAIN . '/api/posts', $data);
    }

    public function update(int $id, array $data)
    {
        Http::withToken(self::$token)->patch(self::DOMAIN . "/api/posts/$id", $data);
    }

    public function delete(int $id)
    {
        Http::withToken(self::$token)->delete(self::DOMAIN . "/api/posts/$id");

//        $responsce->successful();
    }

    public function login(): self
    {
        self::$token = Http::post(self::DOMAIN . '/api/auth/login', [
            "email" => config('sun.email'),
            "password" => config('sun.password')
        ])->collect()['access_token'];

        return $this;
    }
}
