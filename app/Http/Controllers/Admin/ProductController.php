<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->sortBy('name');

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $thumb = $request->file('thumb')->store('products');

        $product = Product::create([
            'name' => $request->name,
            'oem_code' => $request->oem_code,
            'internal_code' => $request->internal_code,
            'thumb' => $thumb
        ]);

        if($request->has('categories')){
            $product->categories()->attach($request->categories);
        }

        return to_route('admin.products.index')->with('success', 'Produto cadastrado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $produto)
    {
        $product = Product::find($produto->id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $produto)
    {
        $product = Product::find($produto->id);

        $request->validate([
            'name',
            'oem_code',
            'internal_code'
        ]);

        $thumb = $product->thumb;
        if ($request->hasFile('thumb')) {
            Storage::delete($product->thumb);
            $thumb = $request->file('thumb')->store('products');
        }

        $product->update([
            'name' => $request->name,
            'oem_code' => $request->oem_code,
            'internal_code' => $request->internal_code,
            'thumb' => $thumb
        ]);

        if($request->has('categories')){
            $product->categories()->detach();
            $product->categories()->attach($request->categories);
        }

        return to_route('admin.products.index')->with('success', 'Produto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $produto)
    {
        $product = Product::find($produto->id);

        $product->categories()->detach();
        $product->cars()->detach();

        Storage::delete($product->thumb);
        $product->delete();

        return to_route('admin.products.index')->with('success', 'Produto deletado com sucesso.');
    }
}
