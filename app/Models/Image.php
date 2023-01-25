<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property int $user_id
 * @property int $item_id
 * @property string $name
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereCreatedAt($value)
 * @method static Builder|Image whereDescription($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereItemId($value)
 * @method static Builder|Image whereName($value)
 * @method static Builder|Image whereUpdatedAt($value)
 * @method static Builder|Image whereUserId($value)
 * @mixin Eloquent
 * @property string $url
 * @property-read Collection|Label[] $labels
 * @property-read int|null $labels_count
 * @property-read User $user
 * @method static Builder|Image forUser(User $user)
 * @method static Builder|Image whereUrl($value)
 * @property-read \App\Models\Item|null $item
 */
class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function labels(): HasMany
    {
        return $this->hasMany(Label::class);
    }

    public function scopeForUser(Builder $query, User $user): Builder
    {
        return $query->whereUserId($user->id);
    }

}
