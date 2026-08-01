<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('order')->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:pages,slug|max:255',
            'content' => 'nullable',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
            'meta_keywords' => 'nullable|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'order' => 'nullable|integer|min:0',
        ]);

        $data = $request->except(['featured_image', 'og_image', 'sections', '_token']);
        
        // Auto-generate slug from title if not provided
        if (empty($request->slug)) {
            $baseSlug = Str::slug($request->title);
            $slug = $baseSlug;
            $counter = 1;
            while (Page::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;
        } else {
            $data['slug'] = Str::slug($request->slug);
        }
        
        $data['is_published'] = $request->has('is_published');
        $data['show_in_menu'] = $request->has('show_in_menu');
        $data['order'] = $request->order ?? 0;

        // Handle sections as JSON
        if ($request->has('sections')) {
            $data['sections'] = $this->processSections($request->sections);
        }

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = ImageService::uploadAndConvert($request->file('featured_image'), 'pages');
        }

        if ($request->hasFile('og_image')) {
            $data['og_image'] = ImageService::uploadAndConvert($request->file('og_image'), 'pages/og');
        }

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|unique:pages,slug,' . $page->id . '|max:255',
            'content' => 'nullable',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:500',
            'meta_keywords' => 'nullable|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'order' => 'nullable|integer|min:0',
        ]);

        $data = $request->except(['featured_image', 'og_image', 'sections', '_token', '_method']);
        
        // Jangan ubah slug jika tidak diubah manual
        if (!empty($request->slug)) {
            $data['slug'] = Str::slug($request->slug);
        } else {
            // Jika slug kosong, tetap pakai slug yang lama
            unset($data['slug']);
        }
        
        $data['is_published'] = $request->has('is_published');
        $data['show_in_menu'] = $request->has('show_in_menu');
        $data['order'] = $request->order ?? $page->order;

        // Handle sections as JSON
        if ($request->has('sections')) {
            $data['sections'] = $this->processSections($request->sections);
        }

        if ($request->hasFile('featured_image')) {
            ImageService::delete($page->featured_image);
            $data['featured_image'] = ImageService::uploadAndConvert($request->file('featured_image'), 'pages');
        }

        if ($request->hasFile('og_image')) {
            ImageService::delete($page->og_image);
            $data['og_image'] = ImageService::uploadAndConvert($request->file('og_image'), 'pages/og');
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        ImageService::delete($page->featured_image);
        ImageService::delete($page->og_image);
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }

    /**
     * Process sections array to ensure proper format
     */
    private function processSections($sections): array
    {
        if (is_string($sections)) {
            return json_decode($sections, true) ?? [];
        }
        return is_array($sections) ? $sections : [];
    }
}
