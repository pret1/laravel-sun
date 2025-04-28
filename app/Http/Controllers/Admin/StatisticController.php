<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Inertia\Response;

class StatisticController extends Controller
{
    public function index(): Response
    {
        $statistics = Statistic::orderBy('date', 'desc')->get();

        return inertia('Admin/Statistics/Index', [
            'statistics' => $statistics
        ]);
    }
}
