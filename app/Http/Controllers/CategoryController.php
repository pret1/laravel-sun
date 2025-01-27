<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function store()
    {
        $data = [
            'title' => 'new category',
        ];

        return Category::create($data);
    }

    public function update(Category $category)
    {
        $data = [
            'title' => 'update category'
        ];

        $category->update($data);
        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response('deleted', 200);
    }
}
