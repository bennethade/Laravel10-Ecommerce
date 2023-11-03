<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get()->take(12);
        // $products = Product::orderBy('created_at', 'DESC')->paginate(12);
        return view('index', ['products' => $products]);
    }
}
