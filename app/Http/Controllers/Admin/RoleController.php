<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Resources\Role\RoleResource;
use Inertia\Response;
use Inertia\ResponseFactory;

class RoleController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $roles = RoleResource::collection(Role::all())->resolve();
        return inertia("Admin/Role/Index", compact('roles'));
    }

    public function show(Role $role): Response|ResponseFactory
    {
        $role = RoleResource::make($role)->resolve();
        return inertia("Admin/Role/Show", compact('role'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia("Admin/Role/Create");
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $role = Role::create($data);
        return RoleResource::make($role)->resolve();

    }
}
