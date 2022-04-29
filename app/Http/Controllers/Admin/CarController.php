<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarStoreRequest;
use App\Models\Automaker;
use App\Models\Car;
use App\Models\Product;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $automakers = Automaker::all();
        $cars = Car::query()->orderBy(Automaker::select('name')->whereColumn('automakers.id', 'cars.automaker_id'))->orderBy('name')->orderBy('model')->orderBy('engine')->orderBy('initial_year')->get();

        return view('admin.cars.index', compact('cars', 'automakers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $automakers= Automaker::all();
        $products= Product::all();

        return view('admin.cars.create', compact('automakers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarStoreRequest $request)
    {
        $car = Car::create([
            'automaker_id' => $request->automaker_id,
            'name' => $request->name,
            'model'=> $request->model,
            'engine' => $request->engine,
            'initial_year' => $request->initial_year,
            'final_year' =>  $request->final_year
        ]);

        if($request->has('automaker')){
            $car->automakers()->attach($request->automaker);
        }

        if($request->has('product')){
            $car->products()->attach($request->product);
        }

        return to_route('admin.cars.index')->with('success', 'Carro cadastrado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $carro)
    {
        $car = Car::find($carro->id);
        $products= Product::all();
        $automakers = Automaker::all();

        return view('admin.cars.edit', compact('car', 'automakers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $carro)
    {
        $car = Car::find($carro->id);

        $request->validate([
            'automaker_id',
            'name',
            'model',
            'engine',
            'initial_year',
            'final_year'
        ]);

        $car = Car::update([
            'automaker_id' => $request->automaker_id,
            'name' => $request->name,
            'model'=> $request->model,
            'engine' => $request->engine,
            'initial_year' => $request->initial_year,
            'final_year' =>  $request->final_year
        ]);

        if($request->has('automaker')){
            $car->automakers()->attach($request->automaker);
        }

        if($request->has('product')){
            $car->products()->attach($request->product);
        }

        return to_route('admin.cars.index')->with('success', 'Carro atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $carro)
    {
        $car = Car::find($carro->id);

        $car->products()->detach();
        $car->automakers()->detach();

        $car->delete();

        return to_route('admin.cars.index')->with('success', 'Carro deletado com sucesso.');
    }
}
