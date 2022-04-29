<?php

namespace App\Http\Controllers;

use App\Models\Automaker;
use App\Models\Car;
use App\Models\Product;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneratorController extends Controller
{
    public function show()
    {
        $automakers = Automaker::all();
        $products = Product::all();

        //$pdf = PDF::loadView('catalogue', compact('products', 'automakers'));
        //return $pdf->setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => true])->setPaper('A4')->stream('catalogo.pdf');

        return view('catalogue', compact('products', 'automakers'));
    }
}
