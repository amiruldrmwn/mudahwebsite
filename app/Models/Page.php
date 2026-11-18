<?php

namespace App\Models;

use App\Support\Themes;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * A page of the website, built from sections (see App\Sections\SectionTypes).
 *
 * Pages belong to a group of templates (preset, see Themes::all()). Queries only see the pages
 * of the template in use; the others are kept for when the owner switches back.
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $preset
 * @property bool $is_home
 * @property bool $in_menu
 * @property bool $published
 * @property int $position
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property list<array{id: string, type: string, data: array<string, mixed>}> $sections
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['title', 'slug', 'preset', 'is_home', 'in_menu', 'published', 'position', 'meta_title', 'meta_description', 'sections'])]
class Page extends Model
{
    protected static function booted(): void
    {
        static::addGlobalScope('preset', fn (Builder $query) => $query->where('pages.preset', Themes::currentPreset()));
        static::creating(fn (Page $page) => $page->preset ??= Themes::currentPreset());
    }

    /**
     * Pages of every template group.
     *
     * @return Builder<Page>
     */
    public static function allPresets(): Builder
    {
        return self::query()->withoutGlobalScope('preset');
    }

    protected function casts(): array
    {
        return [
            'is_home' => 'boolean',
            'in_menu' => 'boolean',
            'published' => 'boolean',
            'position' => 'integer',
            'sections' => 'array',
        ];
    }

    /**
     * Published pages shown in the menu, in order.
     *
     * @param  Builder<Page>  $query
     */
    public function scopeMenu(Builder $query): void
    {
        $query->where('published', true)->where('in_menu', true)->orderBy('position')->orderBy('id');
    }

    public function url(): string
    {
        return $this->is_home ? url('/') : url($this->slug);
    }
}
