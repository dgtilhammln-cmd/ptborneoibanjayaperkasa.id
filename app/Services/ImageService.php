<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Encoders\WebpEncoder;

class ImageService
{
    /**
     * Upload and convert image to WebP format
     * Optimizes file size while maintaining quality and resolution
     *
     * @param UploadedFile $file The uploaded file
     * @param string $folder The storage folder (e.g., 'blogs', 'products')
     * @param int $quality WebP quality (1-100), default 85 for good balance
     * @return string The path to the stored image
     */
    public static function uploadAndConvert(UploadedFile $file, string $folder = 'uploads', int $quality = 85): string
    {
        // Generate unique filename with webp extension
        $filename = Str::uuid() . '.webp';
        $path = $folder . '/' . $filename;

        // Read the uploaded image
        $image = Image::read($file->getRealPath());

        // Encode to WebP format with specified quality
        // Higher quality = larger file, but still much smaller than JPG/PNG
        $encoded = $image->encode(new WebpEncoder(quality: $quality));

        // Store the converted image
        Storage::disk('public')->put($path, $encoded->toString());

        return '/storage/' . $path;
    }

    /**
     * Upload multiple images and convert to WebP
     *
     * @param array $files Array of UploadedFile
     * @param string $folder The storage folder
     * @param int $quality WebP quality
     * @return array Array of stored image paths
     */
    public static function uploadMultiple(array $files, string $folder = 'uploads', int $quality = 85): array
    {
        $paths = [];

        foreach ($files as $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $paths[] = self::uploadAndConvert($file, $folder, $quality);
            }
        }

        return $paths;
    }

    /**
     * Delete an image from storage
     *
     * @param string|null $path The image path
     * @return bool
     */
    public static function delete(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        // Skip external URLs (http:// or https://)
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return true; // Return true for external URLs (can't delete them, but it's not an error)
        }

        // Remove /storage/ prefix to get the actual path
        $storagePath = str_replace('/storage/', '', $path);

        if (Storage::disk('public')->exists($storagePath)) {
            return Storage::disk('public')->delete($storagePath);
        }

        return true; // Return true even if file doesn't exist (already deleted or never existed)
    }
}
