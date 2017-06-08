<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    public function show()
    {
        return view('admin.products', ['products' => Product::with('promotions')->orderByDesc('id')->get()]);
    }
}
