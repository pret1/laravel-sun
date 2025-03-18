<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LogDbQueries
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = auth()->id();
//        $route = $request->route();
        $path = $request->path();

        $data = [
            'insert' => 0,
            'update' => 0,
            'select' => 0,
            'delete' => 0,
            'log' => []
        ];

//        DB::listen(function (QueryExecuted $query) use (&$data, $response, $userId, $path) {
        DB::listen(function (QueryExecuted $query) use (&$data) {
            $sql = $query->sql;
            $time = $query->time;

            $operation = strtolower(strtok($sql, ' '));

            if (isset($data[$operation])) {
                $data[$operation]++;
            }

            $data['log'][] = [
                'sql' => $sql,
                'time' => $time,
            ];
        });

        $response = $next($request);

        DB::table('db_logs')->insert([
            'user_id' => $userId,
            'select_count' => $data['select'],
            'insert_count' => $data['insert'],
            'update_count' => $data['update'],
            'delete_count' => $data['delete'],
            'sql' => json_encode($data['log']),
            'status' => $response->status(),
            'time' => microtime(true) - LARAVEL_START,
//            'time' => $data['log']['time'],
            'message' => null,
            'route' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $response;
    }
}
