<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

/**
 * What the owner wrote about an image in the media library (see App\Support\Media).
 *
 * @property string $path
 * @property string $alt
 */
#[Fillable(['path', 'alt'])]
class MediaMeta extends Model
{
    protected $table = 'media_meta';

    protected $primaryKey = 'path';

    public $incrementing = false;

    protected $keyType = 'string';
}
