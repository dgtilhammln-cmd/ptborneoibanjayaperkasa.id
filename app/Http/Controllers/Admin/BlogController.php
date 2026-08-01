<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'nullable|unique:blogs,slug|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $data = $request->all();
        
        // Auto-generate slug hanya jika kosong
        if (empty($data['slug'])) {
            $baseSlug = Str::slug($request->title);
            $slug = $baseSlug;
            $counter = 1;
            while (Blog::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        if ($request->hasFile('image')) {
            $data['image'] = ImageService::uploadAndConvert($request->file('image'), 'blogs');
        }

        Blog::create($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'nullable|unique:blogs,slug,' . $blog->id . '|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
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
            ImageService::delete($blog->image);
            // Upload new image
            $data['image'] = ImageService::uploadAndConvert($request->file('image'), 'blogs');
        }

        $blog->update($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        ImageService::delete($blog->image);
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog deleted successfully.');
    }
}
