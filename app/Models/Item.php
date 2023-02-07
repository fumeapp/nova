<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Item
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Item newModelQuery()
 * @method static Builder|Item newQuery()
 * @method static Builder|Item query()
 * @method static Builder|Item whereCreatedAt($value)
 * @method static Builder|Item whereDescription($value)
 * @method static Builder|Item whereId($value)
 * @method static Builder|Item whereName($value)
 * @method static Builder|Item whereUpdatedAt($value)
 * @method static Builder|Item whereUserId($value)
 * @mixin Eloquent
 * @property string $title
 * @method static Builder|Item whereTitle($value)
 * @property array|null $location
 * @property-read Collection|Image[] $images
 * @property-read int|null $images_count
 * @property-read Collection|Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read User $user
 * @method static Builder|Item whereLocation($value)
 */
class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): hasMany
    {
        return $this->hasMany(Image::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
