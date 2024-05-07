<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function index(Request $request)
    {

        $searchQuery = $request->input('searchQuery');
        $manufacturer = $request->input('manufacturer');

        $products = Product::search($searchQuery, $manufacturer);

        return Inertia::render('Search', ['products' => $products]);
    }

    public function getManufacturers()
    {
        $manufacturers = Product::distinct()->pluck('producer');
        return response()->json($manufacturers);
    }
}
