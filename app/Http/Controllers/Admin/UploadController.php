<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Handle image upload from Summernote editor
     * Automatically converts to WebP format
     */
    public function image(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        if ($request->hasFile('image')) {
            $path = ImageService::uploadAndConvert($request->file('image'), 'editor');

            return response()->json([
                'success' => true,
                'url' => $path,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No image file provided',
        ], 400);
    }
}
