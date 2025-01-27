<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    public function show(Role $role)
    {
        return $role;
    }

    public function store()
    {
        $data = [
            'title' => 'new role',
        ];

        return Role::create($data);
    }

    public function update(Role $role)
    {
        $data = [
            'title' => 'update role',
        ];

        $role->update($data);
        return $role;
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response('deleted', 200);
    }
}
