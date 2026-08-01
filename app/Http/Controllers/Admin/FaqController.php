<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Service;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::with('service')->ordered()->paginate(20);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $services = Service::orderBy('name')->get();
        return view('admin.faqs.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'service_id' => 'nullable|exists:services,id',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'service_id' => $request->service_id ?: null,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq)
    {
        $services = Service::orderBy('name')->get();
        return view('admin.faqs.edit', compact('faq', 'services'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'service_id' => 'nullable|exists:services,id',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'service_id' => $request->service_id ?: null,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
