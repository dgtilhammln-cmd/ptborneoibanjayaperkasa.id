<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CompressImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:compress {--max-width=1600}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compress and resize all large webp/jpg/png images in public storage to boost PageSpeed.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $maxWidth = (int) $this->option('max-width');
        $this->info("Starting image compression... Max width: {$maxWidth}px");

        $disk = Storage::disk('public');
        $files = $disk->allFiles();
        $compressedCount = 0;

        foreach ($files as $file) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                continue;
            }

            $path = $disk->path($file);
            $size = filesize($path);
            
            // Only process if larger than 300KB
            if ($size < 300 * 1024) {
                continue;
            }

            // Get image info
            $info = @getimagesize($path);
            if (!$info) continue;

            list($width, $height) = $info;

            if ($width <= $maxWidth && $size < 500 * 1024) {
                continue; // Already small enough
            }

            $this->line("Compressing: {$file} ({$width}x{$height}) - " . round($size / 1024) . "KB");

            // Calculate new dimensions
            $newWidth = $width;
            $newHeight = $height;
            if ($width > $maxWidth) {
                $newWidth = $maxWidth;
                $newHeight = (int) (($height / $width) * $newWidth);
            }

            // Create image resource
            $image = null;
            if ($extension === 'jpg' || $extension === 'jpeg') {
                $image = @imagecreatefromjpeg($path);
            } elseif ($extension === 'png') {
                $image = @imagecreatefrompng($path);
            } elseif ($extension === 'webp') {
                $image = @imagecreatefromwebp($path);
            }

            if (!$image) {
                $this->error("Failed to read image: {$file}");
                continue;
            }

            $newImage = imagecreatetruecolor($newWidth, $newHeight);
            
            // Preserve transparency
            if ($extension === 'png' || $extension === 'webp') {
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);
                $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
                imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
            }

            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // Save the image
            if ($extension === 'jpg' || $extension === 'jpeg') {
                imagejpeg($newImage, $path, 75);
            } elseif ($extension === 'png') {
                imagepng($newImage, $path, 8);
            } elseif ($extension === 'webp') {
                imagewebp($newImage, $path, 75);
            }

            imagedestroy($image);
            imagedestroy($newImage);

            clearstatcache();
            $newSize = filesize($path);
            $this->info(" -> Reduced to " . round($newSize / 1024) . "KB");
            $compressedCount++;
        }

        $this->info("Completed! Compressed {$compressedCount} large images.");
    }
}

