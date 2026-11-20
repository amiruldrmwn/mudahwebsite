<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaMeta;
use App\Support\Media;
use App\Support\SiteImages;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

/**
 * The media library: the Media page, the picker's list (JSON), uploads, replacing a file,
 * descriptions and deletes. Uploads return the stored path (kept in the section) and its URL.
 */
class MediaController extends Controller
{
    private const FILE_RULES = ['required', 'file', 'mimes:png,jpg,jpeg,webp,gif,svg,avif', 'max:15360'];

    public function index(Request $request, Media $media): Response|JsonResponse
    {
        if ($request->wantsJson()) {
            return response()->json(['media' => $media->all()]);
        }

        return Inertia::render('media/Index', ['media' => $media->all(), 'maxSide' => Media::MAX_SIDE]);
    }

    public function store(Request $request, Media $media): JsonResponse
    {
        $request->validate(['file' => self::FILE_RULES], [], ['file' => 'gambar']);

        return $this->stored($media->store($request->file('file')));
    }

    public function replace(Request $request, Media $media): JsonResponse
    {
        $request->validate(['path' => ['required', 'string'], 'file' => self::FILE_RULES], [], ['file' => 'gambar']);
        $path = $this->libraryPath($request, $media);

        return $this->stored($media->replace($path, $request->file('file')));
    }

    public function describe(Request $request, Media $media): JsonResponse
    {
        $request->validate(['path' => ['required', 'string'], 'alt' => ['nullable', 'string', 'max:250']], [], ['alt' => 'deskripsi']);
        $path = $this->libraryPath($request, $media);
        $alt = trim((string) $request->input('alt'));

        MediaMeta::query()->updateOrCreate(['path' => $path], ['alt' => $alt]);
        SiteImages::flush();

        return response()->json(['path' => $path, 'alt' => $alt]);
    }

    public function destroy(Request $request, Media $media): JsonResponse
    {
        $path = $this->libraryPath($request, $media);

        if ($usedIn = $media->usage()[$path] ?? []) {
            throw ValidationException::withMessages(['path' => 'Gambar masih dipakai di '.implode(', ', array_column($usedIn, 'label')).'. Ganti dulu gambarnya di sana, lalu hapus.']);
        }

        $media->delete($path);

        return response()->json(['deleted' => $path]);
    }

    private function libraryPath(Request $request, Media $media): string
    {
        $path = (string) $request->input('path');

        abort_unless($media->isLibraryPath($path), 404);

        return $path;
    }

    private function stored(string $path): JsonResponse
    {
        $disk = Storage::disk('public');

        return response()->json(['path' => $path, 'url' => $disk->url($path), 'size' => $disk->size($path)]);
    }
}
