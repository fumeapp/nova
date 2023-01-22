<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Label
 *
 * @property int $id
 * @property int $image_id
 * @property string $name
 * @property string $confidence
 * @property array $categories
 * @property-read \App\Models\Image $image
 * @method static \Illuminate\Database\Eloquent\Builder|Label newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Label newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Label query()
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereCategories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereConfidence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Label whereName($value)
 * @mixin \Eloquent
 */
class Label extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = ['categories' => 'array'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
