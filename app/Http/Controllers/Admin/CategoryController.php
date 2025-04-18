<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Inertia\Response;
use Inertia\ResponseFactory;

class CategoryController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        return inertia('Admin/Category/Index', compact('categories'));
    }

    public function show(Category $category): Response
    {
        $category = CategoryResource::make($category)->resolve();
        return inertia('Admin/Category/Show', compact('category'));
    }

    public function create(): Response
    {
        return inertia('Admin/Category/Create');
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $category = Category::create($data);
        return CategoryResource::make($category)->resolve();
    }
}
