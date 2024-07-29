<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
    // Récupération des filtres depuis la requête
    $categoryFilter = request()->category_filter;
    $minStock = request()->min_stock;
    $maxStock = request()->max_stock;

    // Requête de base pour récupérer les produits avec leur catégorie
    $productsQuery = Product::with('category');

    // Application du filtre de catégorie, si sélectionné
    if ($categoryFilter) {
        $productsQuery->where('category_id', $categoryFilter);
    }

    // Application du filtre de stock minimum, si renseigné
    if ($minStock) {
        $productsQuery->where('stock', '>=', $minStock);
    }

    // Application du filtre de stock maximum, si renseigné
    if ($maxStock) {
        $productsQuery->where('stock', '<=', $maxStock);
    }

    // Récupération des produits filtrés
    $products = $productsQuery->get();

    // Récupération de toutes les catégories pour le filtre
    $categories = Category::all();

    // Retour de la vue avec les produits et les catégories
    return view('products', compact('products', 'categories'));
}


    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index');
    }

   

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
