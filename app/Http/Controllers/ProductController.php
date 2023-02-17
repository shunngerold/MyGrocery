<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    // Show Products
    public function show_products() {
        return view('user.product-content', [
            'products' => Products::latest()
            ->filter(request(['category','search']))
            ->paginate(12)
        ]);
    }

}
