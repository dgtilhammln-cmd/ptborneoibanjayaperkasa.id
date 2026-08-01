<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::orderBy('order')->orderBy('name')->paginate(20);
        return view('admin.product-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active');

        ProductCategory::create($validated);

        return redirect()->route('admin.product-categories.index')
            ->with('success', 'Kategori produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        $productCategory->load('products');
        return view('admin.product-categories.show', compact('productCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-categories.edit', compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $productCategory->id,
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        // kalau nama berubah, generate slug baru yang unik
        if ($productCategory->name !== $validated['name']) {
            $validated['slug'] = $this->generateUniqueSlug($validated['name'], $productCategory->id);

            // NOTE (opsional tapi penting):
            // Karena relasi products kamu pakai slug (products.category = categories.slug),
            // kalau kamu ganti slug category, relasi bisa putus.
            // Kalau mau aman, update juga produk yang pakai slug lama:
            //
            // \App\Models\Product::where('category', $productCategory->slug)
            //     ->update(['category' => $validated['slug']]);
        }

        $validated['is_active'] = $request->boolean('is_active');

        $productCategory->update($validated);

        return redirect()->route('admin.product-categories.index')
            ->with('success', 'Kategori produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productsCount = $productCategory->products()->count();

        if ($productsCount > 0) {
            return redirect()->route('admin.product-categories.index')
                ->with('error', "Tidak dapat menghapus kategori karena masih memiliki {$productsCount} produk. Pindahkan produk terlebih dahulu.");
        }

        $productCategory->delete();

        return redirect()->route('admin.product-categories.index')
            ->with('success', 'Kategori produk berhasil dihapus.');
    }

    /**
     * Generate unique slug for product_categories.slug
     */
    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $i = 1;

        $query = ProductCategory::query()->where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = $baseSlug . '-' . $i++;

            $query = ProductCategory::query()->where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
        }

        return $slug;
    }
}
