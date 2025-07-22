<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/uploads/{filename}', function ($filename) {
    $path = 'uploads/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $content = Storage::disk('public')->get($path);
    $mime = Storage::disk('public')->mimeType($path);

    return Response::make($content, 200)
        ->header('Content-Type', $mime)
        ->header('Access-Control-Allow-Origin', '*');
});