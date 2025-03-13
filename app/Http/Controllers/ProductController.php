<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

  
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->storeAs('products', $imageName, 'public');
                
  
                Log::info('Image uploaded successfully: ' . $imagePath);
            } else {
                Log::error('Image upload failed - no file provided');
                return back()->withErrors(['image' => 'Image upload failed'])->withInput();
            }

            $product = Product::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'image' => $imagePath,
            ]);

     
            Log::info('Product created successfully', ['product_id' => $product->id]);

            return redirect()->route('admin.products.create')
                ->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
        
            Log::error('Product creation failed: ' . $e->getMessage());
            
            return back()->withErrors(['error' => 'Failed to add product: ' . $e->getMessage()])
                ->withInput();
        }
    }
}