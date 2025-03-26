<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;
use App\Http\Requests\Admin\Permission\StoreRequest;

class PermissionController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $permissions = Permission::all();
        return inertia('Admin/Permission/Index', compact('permissions'));
    }

    public function show(Permission $permission): Response
    {
        return inertia('Admin/Permission/Show', compact('permission'));
    }

    public function create(): Response
    {
        return inertia('Admin/Permission/Create');
    }

    public function store(StoreRequest $request): Response
    {
        $data = $request->validated();
        return Permission::create($data);
    }
}
