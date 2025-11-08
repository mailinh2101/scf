<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::where('published', true);

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(6)->withQueryString();

        return view('products', ['products' => $products]);
    }
}
