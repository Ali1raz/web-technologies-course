<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::select("SELECT * FROM products ORDER BY created_at DESC");
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string'
        ]);

        DB::insert("
            INSERT INTO products (name, price, stock, description, created_at, updated_at)
            VALUES (?, ?, ?, ?, NOW(), NOW())
        ", [
            $request->name,
            $request->price,
            $request->stock,
            $request->description
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = DB::select("SELECT * FROM products WHERE id = ?", [$id])[0];
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string'
        ]);

        DB::update("
            UPDATE products 
            SET name = ?, price = ?, stock = ?, description = ?, updated_at = NOW()
            WHERE id = ?
        ", [
            $request->name,
            $request->price,
            $request->stock,
            $request->description,
            $id
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        DB::delete("DELETE FROM products WHERE id = ?", [$id]);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
