<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Intervention\Image\ImageManager;
use Throwable;

class AvatarService
{
    public function store(UploadedFile $file): string
    {
        try {
            $image = ImageManager::gd()->read($file->getPathname())
                ->cover(300, 300)->toJpeg(quality: 85);
        } catch (Throwable $exception) {
            report($exception);
            throw ValidationException::withMessages([
                'avatar' => 'This image could not be prepared. Please choose another JPG, PNG, or WebP image.',
            ]);
        }

        $path = 'avatars/'.Str::uuid().'.jpg';
        if (! Storage::disk('public')->put($path, (string) $image)) {
            throw ValidationException::withMessages([
                'avatar' => 'The image could not be saved. Please try again.',
            ]);
        }

        return $path;
    }

    public function deleteUpload(?string $path): void
    {
        // Never delete the original bundled TFA6 images or arbitrary paths.
        if ($path && preg_match('/^avatars\/[a-f0-9-]{36}\.jpg$/', $path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
