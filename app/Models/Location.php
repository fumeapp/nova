<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * App\Models\Location
 *
 * @property int $id
 * @property int|null $item_id
 * @property mixed $coordinate
 * @property string $payload
 * @property string $place_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Location newModelQuery()
 * @method static Builder|Location newQuery()
 * @method static Builder|Location query()
 * @method static Builder|Location whereCoordinate($value)
 * @method static Builder|Location whereCreatedAt($value)
 * @method static Builder|Location whereId($value)
 * @method static Builder|Location whereItemId($value)
 * @method static Builder|Location wherePayload($value)
 * @method static Builder|Location wherePlaceId($value)
 * @method static Builder|Location whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Location extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'coordinate' => Point::class,
        'payload' => 'array',
    ];

    public array $interfaces = [
        'payload' => [
            'import' => '@/types/api',
            'type' => 'LocationPayload',
        ],
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
