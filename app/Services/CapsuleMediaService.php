<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class CapsuleMediaService
{

    static function saveBase64File(string $base64file){
        if (!str_starts_with($base64file, 'data:'))     return false;

        [$meta, $base64Data] = explode(',', $base64file, 2);

        if (!preg_match('/^data:(.*?);base64$/', $meta, $matches)) return false;

        $mimeType = $matches[1];
        $extension = explode('/', $mimeType)[1] ?? 'bin';

        if ($extension === 'plain')     $extension = 'txt';

        $fileContent = base64_decode($base64Data);

        if ($fileContent === false)     return false;

        $fileName = uniqid() . '.' . $extension;
        $saved = Storage::disk('public')->put("uploads/{$fileName}", $fileContent);

        return $saved ? $fileName : false;
    }
}