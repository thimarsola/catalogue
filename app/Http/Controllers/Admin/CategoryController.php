<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all()->sortBy('name');

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CategoryStoreRequest $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        return to_route('admin.categories.index')->with('success', 'Categoria cadastrada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $categoria
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Category $categoria)
    {
        $category = Category::find($categoria->id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $categoria
     * @return void
     */
    public function update(Request $request, Category $categoria)
    {
        $category = Category::find($categoria->id);

        $request->validate([
            'name' => 'required'
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return to_route('admin.categories.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $categoria
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $categoria)
    {
        $category = Category::find($categoria->id);
        $category->delete();

        return to_route('admin.categories.index')->with('success', 'Categoria deletada com sucesso.');
    }
}
