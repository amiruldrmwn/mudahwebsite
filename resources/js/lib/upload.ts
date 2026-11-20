import { post } from '@/lib/http';
import { destroy, index, store } from '@/routes/media';

/** An image in the media library (media/ on the site's storage). */
export type MediaItem = {
    path: string;
    url: string;
    name: string;
    size: number;
    width: number | null;
    height: number | null;
    modified: number;
    used_in: { label: string; href: string }[];
};

/**
 * Upload an image for a page section. Resolves to its stored path, or throws
 * with the server's message. The server shrinks and compresses photos.
 */
export async function uploadImage(file: File): Promise<string> {
    const body = new FormData();
    body.append('file', file);

    const json = (await (await post(store.url(), body)).json()) as {
        path?: string;
    };

    if (!json.path) {
        throw new Error('Gambar gagal diunggah.');
    }

    return json.path;
}

/** Every image in the library, newest first. */
export async function listMedia(): Promise<MediaItem[]> {
    const response = await fetch(index.url(), {
        headers: { Accept: 'application/json' },
        credentials: 'same-origin',
    });

    if (!response.ok) {
        throw new Error('Galeri gagal dimuat. Coba lagi.');
    }

    return ((await response.json()) as { media: MediaItem[] }).media;
}

/** Delete an unused image; throws with where it is still used. */
export async function deleteMedia(path: string): Promise<void> {
    await post(destroy.url(), { path });
}

/** "1,2 MB", "340 KB". */
export function fileSize(bytes: number): string {
    return bytes >= 1024 * 1024
        ? `${(bytes / 1024 / 1024).toLocaleString('id-ID', { maximumFractionDigits: 1 })} MB`
        : `${Math.max(1, Math.round(bytes / 1024))} KB`;
}
