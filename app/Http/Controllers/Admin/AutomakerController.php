<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AutomakerStoreRequest;
use App\Models\Automaker;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AutomakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $automakers = Automaker::all()->sortBy('name');

        return view('admin.automakers.index', compact('automakers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.automakers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AutomakerStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AutomakerStoreRequest $request)
    {
        $logo = $request->file('logo')->store('automakers');

        Automaker::create([
            'name' => $request->name,
            'logo' => $logo
        ]);

        return to_route('admin.automakers.index')->with('success', 'Montadora cadastrada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Automaker $montadora)
    {
        $automaker = Automaker::find($montadora->id);
        return view('admin.automakers.edit', compact('automaker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Automaker $montadora
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Automaker $montadora)
    {
        $automaker = Automaker::find($montadora->id);

        $request->validate([
            'name' => 'required',
        ]);

        $logo = $automaker->logo;
        if ($request->hasFile('logo')) {
            Storage::delete($automaker->logo);
            $logo = $request->file('logo')->store('automakers');
        }

        $automaker->update([
            'name' => $request->name,
            'logo' => $logo
        ]);
        return to_route('admin.automakers.index')->with('success', 'Montadora atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Automaker $montadora
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Automaker $montadora)
    {
        $automaker = Automaker::find($montadora->id);

        Storage::delete($automaker->logo);
        $automaker->delete();

        return to_route('admin.automakers.index')->with('success', 'Montadora deletada com sucesso.');
    }
}
