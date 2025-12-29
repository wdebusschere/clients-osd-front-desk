<?php

namespace App\Http\Controllers;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MediaController extends Controller
{
    public function render(Media $media, string $conversion = ''): BinaryFileResponse
    {
        return response()->file($media->getPath($conversion));
    }

    public function download(Media $media): BinaryFileResponse
    {
        return response()->download($media->getPath(), $media->file_name);
    }
}

