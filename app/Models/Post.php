<?php

namespace App\Models;

use App\Support\RichText;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * A blog post (Blog / Berita). Its body is HTML from the editor, cleaned by RichText on save.
 *
 * A post is live when it is published and its publish time has come; a published post with a
 * later time is scheduled, and shows up by itself at that time.
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $excerpt
 * @property string $body
 * @property string|null $cover
 * @property string|null $category
 * @property string $status
 * @property Carbon|null $published_at
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['title', 'slug', 'excerpt', 'body', 'cover', 'category', 'status', 'published_at', 'meta_title', 'meta_description'])]
class Post extends Model
{
    public const DRAFT = 'draft';

    public const PUBLISHED = 'published';

    /** Words read per minute, for the reading time. */
    private const WPM = 200;

    protected $attributes = ['status' => self::DRAFT, 'body' => ''];

    protected function casts(): array
    {
        return ['published_at' => 'datetime'];
    }

    /**
     * Posts visitors can read: published, with their time come.
     *
     * @param  Builder<Post>  $query
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('status', self::PUBLISHED)->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    /**
     * Published posts waiting for their time.
     *
     * @param  Builder<Post>  $query
     */
    public function scopeScheduled(Builder $query): void
    {
        $query->where('status', self::PUBLISHED)->where('published_at', '>', now());
    }

    /**
     * @param  Builder<Post>  $query
     */
    public function scopeDraft(Builder $query): void
    {
        $query->where('status', self::DRAFT);
    }

    /**
     * Newest first, the order of the blog.
     *
     * @param  Builder<Post>  $query
     */
    public function scopeLatestFirst(Builder $query): void
    {
        $query->orderByDesc('published_at')->orderByDesc('id');
    }

    /** published, scheduled or draft. */
    public function state(): string
    {
        if ($this->status !== self::PUBLISHED || $this->published_at === null) {
            return 'draft';
        }

        return $this->published_at->isFuture() ? 'scheduled' : 'published';
    }

    public function isLive(): bool
    {
        return $this->state() === 'published';
    }

    public function url(): string
    {
        return url('blog/'.$this->slug);
    }

    public function coverUrl(): ?string
    {
        return $this->cover ? Storage::disk('public')->url($this->cover) : null;
    }

    /** The excerpt, else the start of the body. */
    public function summary(int $length = 160): string
    {
        return Str::limit($this->excerpt ?: RichText::text($this->body), $length);
    }

    public function readingMinutes(): int
    {
        return max(1, (int) ceil(RichText::words($this->body) / self::WPM));
    }

    /** The publish date in the owner's time zone ("5 November 2026"). */
    public function dateLabel(string $format = 'j F Y'): string
    {
        return ($this->published_at ?? $this->created_at ?? now())->timezone(self::timezone())->translatedFormat($format);
    }

    public static function timezone(): string
    {
        $zone = config('compro.timezone');

        return is_string($zone) && in_array($zone, timezone_identifiers_list(), true) ? $zone : 'Asia/Jakarta';
    }

    /**
     * Library images the post uses: its cover and the images in its body.
     *
     * @return list<string>
     */
    public function mediaPaths(): array
    {
        preg_match_all('#/storage/(media/[A-Za-z0-9._-]+)#', $this->body, $m);

        return array_values(array_unique(array_filter([$this->cover, ...$m[1]])));
    }

    /**
     * Categories in use, for the editor's suggestions and the blog's filter.
     *
     * @return list<string>
     */
    public static function categories(bool $liveOnly = false): array
    {
        $categories = self::query()
            ->when($liveOnly, fn (Builder $q) => $q->published())
            ->whereNotNull('category')->where('category', '!=', '')
            ->distinct()->orderBy('category')->pluck('category')->all();

        return array_values(array_map(strval(...), $categories));
    }
}
