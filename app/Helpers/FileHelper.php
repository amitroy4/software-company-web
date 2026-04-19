<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

if (!function_exists('uploadFile')) {
    function uploadFile($file, $path)
    {
        $directory = 'uploads/' . trim((string) $path, '/');
        return storePublicFileOptimized($file, $directory);
    }
}

if (!function_exists('storePublicFileOptimized')) {
    function storePublicFileOptimized(UploadedFile $file, string $directory, ?string $fileName = null): string
    {
        $directory = trim($directory, '/');
        $extension = strtolower((string) $file->getClientOriginalExtension());
        $fileName = $fileName ?: uniqid('', true) . ($extension ? '.' . $extension : '');

        if ($directory === '') {
            return $file->storeAs('', $fileName, 'public');
        }

        $optimizedBinary = optimizeImageBinary($file);
        if ($optimizedBinary === null) {
            return $file->storeAs($directory, $fileName, 'public');
        }

        Storage::disk('public')->put($directory . '/' . $fileName, $optimizedBinary);
        return $directory . '/' . $fileName;
    }
}

if (!function_exists('optimizeImageBinary')) {
    function optimizeImageBinary(UploadedFile $file): ?string
    {
        if (!function_exists('getimagesize') || !function_exists('imagecreatetruecolor')) {
            return null;
        }

        $realPath = $file->getRealPath();
        if (!$realPath || !is_file($realPath)) {
            return null;
        }

        $imageInfo = @getimagesize($realPath);
        if ($imageInfo === false || empty($imageInfo['mime'])) {
            return null;
        }

        $mime = strtolower($imageInfo['mime']);
        $source = null;

        switch ($mime) {
            case 'image/jpeg':
                if (!function_exists('imagecreatefromjpeg') || !function_exists('imagejpeg')) {
                    return null;
                }
                $source = @imagecreatefromjpeg($realPath);
                break;
            case 'image/png':
                if (!function_exists('imagecreatefrompng') || !function_exists('imagepng')) {
                    return null;
                }
                $source = @imagecreatefrompng($realPath);
                break;
            case 'image/gif':
                if (!function_exists('imagecreatefromgif') || !function_exists('imagegif')) {
                    return null;
                }
                $source = @imagecreatefromgif($realPath);
                break;
            case 'image/webp':
                if (!function_exists('imagecreatefromwebp') || !function_exists('imagewebp')) {
                    return null;
                }
                $source = @imagecreatefromwebp($realPath);
                break;
            default:
                return null;
        }

        if (!$source) {
            return null;
        }

        $resized = downscaleImageResource($source, 1920, 1920, $mime);
        if ($resized !== $source) {
            imagedestroy($source);
            $source = $resized;
        }

        ob_start();
        $written = false;

        switch ($mime) {
            case 'image/jpeg':
                $written = imagejpeg($source, null, 82);
                break;
            case 'image/png':
                imagesavealpha($source, true);
                $written = imagepng($source, null, 7);
                break;
            case 'image/gif':
                $written = imagegif($source);
                break;
            case 'image/webp':
                $written = imagewebp($source, null, 80);
                break;
        }

        $binary = $written ? ob_get_clean() : null;
        if (!$written) {
            ob_end_clean();
        }

        imagedestroy($source);
        return $binary ?: null;
    }
}

if (!function_exists('downscaleImageResource')) {
    function downscaleImageResource($source, int $maxWidth, int $maxHeight, string $mime)
    {
        $width = imagesx($source);
        $height = imagesy($source);

        if ($width <= $maxWidth && $height <= $maxHeight) {
            return $source;
        }

        $ratio = min($maxWidth / max($width, 1), $maxHeight / max($height, 1));
        $newWidth = max(1, (int) floor($width * $ratio));
        $newHeight = max(1, (int) floor($height * $ratio));

        $canvas = imagecreatetruecolor($newWidth, $newHeight);
        if ($mime === 'image/png' || $mime === 'image/webp' || $mime === 'image/gif') {
            imagealphablending($canvas, false);
            imagesavealpha($canvas, true);
            $transparent = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
            imagefilledrectangle($canvas, 0, 0, $newWidth, $newHeight, $transparent);
        }

        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        return $canvas;
    }
}

if (!function_exists('deleteFile')) {
    function deleteFile($filePath)
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }
}
