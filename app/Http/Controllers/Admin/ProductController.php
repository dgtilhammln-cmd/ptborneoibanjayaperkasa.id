<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'nullable|unique:products,slug|max:255',
            'category' => 'required|exists:product_categories,slug',
            'description' => 'required',
            'price' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $data = $request->all();
        
        // Auto-generate slug hanya jika kosong
        if (empty($data['slug'])) {
            $baseSlug = Str::slug($request->name);
            $slug = $baseSlug;
            $counter = 1;
            while (Product::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        if ($request->hasFile('image')) {
            $data['image'] = ImageService::uploadAndConvert($request->file('image'), 'products');
        }

        // Handle multiple images
        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $uploadedImages[] = ImageService::uploadAndConvert($file, 'products');
                }
            }
            $data['images'] = $uploadedImages;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'nullable|unique:products,slug,' . $product->id . '|max:255',
            'category' => 'required|exists:product_categories,slug',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'existing_images' => 'nullable|array',
            'existing_images.*' => 'string',
        ]);

        $data = $request->all();
        
        // Jangan ubah slug jika tidak diubah manual
        if (!empty($data['slug'])) {
            $data['slug'] = Str::slug($data['slug']);
        } else {
            // Jika slug kosong, tetap pakai slug yang lama
            unset($data['slug']);
        }

        if ($request->hasFile('image')) {
            // Delete old image
            ImageService::delete($product->image);
            // Upload new image
            $data['image'] = ImageService::uploadAndConvert($request->file('image'), 'products');
        }

        // Handle multiple images
        $existingImages = $request->input('existing_images', []);
        
        // Handle new image uploads
        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $uploadedImages[] = ImageService::uploadAndConvert($file, 'products');
                }
            }
            $existingImages = array_merge($existingImages, $uploadedImages);
        }

        // Delete removed images
        if (isset($product->images) && $product->images && is_array($product->images)) {
            foreach ($product->images as $oldImage) {
                if (!in_array($oldImage, $existingImages)) {
                    ImageService::delete($oldImage);
                }
            }
        }

        // Set images data
        $data['images'] = array_values(array_filter($existingImages));

        try {
            $product->update($data);
        } catch (\Exception $e) {
            // If images column doesn't exist, remove it from data and try again
            if (str_contains($e->getMessage(), "Unknown column 'images'")) {
                unset($data['images']);
                $product->update($data);
                return redirect()->route('admin.products.index')
                    ->with('warning', 'Product updated, but images column not found. Please run: php artisan migrate');
            }
            throw $e;
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete main image
        ImageService::delete($product->image);
        
        // Delete all additional images
        if ($product->images && is_array($product->images)) {
            foreach ($product->images as $image) {
                ImageService::delete($image);
            }
        }
        
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
