<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

/**
 * The media library: the Media page, the picker's list (JSON), uploads and deletes.
 * Uploads return the stored path (kept in the section) and its URL.
 */
class MediaController extends Controller
{
    public function index(Request $request, Media $media): Response|JsonResponse
    {
        if ($request->wantsJson()) {
            return response()->json(['media' => $media->all()]);
        }

        return Inertia::render('media/Index', ['media' => $media->all(), 'maxSide' => Media::MAX_SIDE]);
    }

    public function store(Request $request, Media $media): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:png,jpg,jpeg,webp,gif,svg,avif', 'max:15360'],
        ], [], ['file' => 'gambar']);

        $path = $media->store($request->file('file'));
        $disk = Storage::disk('public');

        return response()->json(['path' => $path, 'url' => $disk->url($path), 'size' => $disk->size($path)]);
    }

    public function destroy(Request $request, Media $media): JsonResponse
    {
        $path = (string) $request->input('path');

        // Only a file directly in the library; never a template photo, a logo or a path outside it.
        if (! preg_match('#^'.Media::DIR.'/[A-Za-z0-9._-]+$#', $path) || ! Storage::disk('public')->exists($path)) {
            abort(404);
        }

        if ($usedIn = $media->usage()[$path] ?? []) {
            throw ValidationException::withMessages(['path' => 'Gambar masih dipakai di '.implode(', ', array_column($usedIn, 'label')).'. Ganti dulu gambarnya di sana, lalu hapus.']);
        }

        Storage::disk('public')->delete($path);

        return response()->json(['deleted' => $path]);
    }
}
