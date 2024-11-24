<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // views/products/
    public function index()
    {
        $products = Product::with(('category'))->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($r->all());

        return redirect()->route('products.index')->with('success', 'Berhasil menambahkan products');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $r, $id)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        
        $product->update($r->all());

        return redirect()->route('products.index')->with('success', 'Berhasil mengubah products');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        $product->delete();
        
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
