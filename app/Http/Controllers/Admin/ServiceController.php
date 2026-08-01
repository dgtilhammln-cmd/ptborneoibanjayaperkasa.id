<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'nullable|unique:services,slug|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'advantages' => 'nullable|array',
            'advantages.*' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        
        // Auto-generate slug hanya jika kosong
        if (empty($data['slug'])) {
            $baseSlug = Str::slug($request->name);
            $slug = $baseSlug;
            $counter = 1;
            while (Service::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;
        } else {
            $data['slug'] = Str::slug($data['slug']);
        }

        if ($request->hasFile('image')) {
            $data['image'] = ImageService::uploadAndConvert($request->file('image'), 'services');
        }

        // Filter out empty advantages
        if (isset($data['advantages'])) {
            $data['advantages'] = array_filter($data['advantages'], function($item) {
                return !empty(trim($item));
            });
            $data['advantages'] = array_values($data['advantages']); // Re-index array
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $faqs = \App\Models\Faq::where('service_id', $service->id)
            ->orWhereNull('service_id')
            ->orderBy('order')
            ->orderBy('id')
            ->get();
        return view('admin.services.edit', compact('service', 'faqs'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'nullable|unique:services,slug,' . $service->id . '|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'advantages' => 'nullable|array',
            'advantages.*' => 'nullable|string|max:255',
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
            ImageService::delete($service->image);
            // Upload new image
            $data['image'] = ImageService::uploadAndConvert($request->file('image'), 'services');
        }

        // Filter out empty advantages
        if (isset($data['advantages'])) {
            $data['advantages'] = array_filter($data['advantages'], function($item) {
                return !empty(trim($item));
            });
            $data['advantages'] = array_values($data['advantages']); // Re-index array
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        ImageService::delete($service->image);
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
