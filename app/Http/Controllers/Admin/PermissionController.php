<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;
use App\Http\Requests\Admin\Permission\StoreRequest;
use App\Http\Resources\Permission\PermissionResource;

class PermissionController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $permissions = PermissionResource::collection(Permission::all())->resolve();
        return inertia('Admin/Permission/Index', compact('permissions'));
    }

    public function show(Permission $permission): Response
    {
        $permission = PermissionResource::make($permission)->resolve();
        return inertia('Admin/Permission/Show', compact('permission'));
    }

    public function create(): Response
    {
        return inertia('Admin/Permission/Create');
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $permission = Permission::create($data);
        return PermissionResource::make($permission)->resolve();
    }
}
