<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Eloquent;
use Fumeapp\Humble\Models\Session;
use Fumeapp\Humble\Traits\Humble;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $email
 * @property string|null $name
 * @property string|null $avatar
 * @property string|null $stripe
 * @property bool $is_sub
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $first_name
 * @property-read bool $has_active_session
 * @property-read string $initials
 * @property-read array $location
 * @property-read Session $session
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Provider[] $providers
 * @property-read int|null $providers_count
 * @property-read Collection|Session[] $sessions
 * @property-read int|null $sessions_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsSub($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereStripe($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 * @property array $payload
 * @method static Builder|User wherePayload($value)
 * @property-read Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 */
class User extends Authenticatable
{
    use HasFactory;
    use Humble;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    protected $appends = ['first_name'];

    protected $casts = ['is_sub' => 'boolean', 'payload' => 'array'];

    public array $interfaces = [
        'location' => [
            'name' => 'api.SessionLocation',
        ],
        'session' => [
            'name' => 'api.Session',
        ],
        'sessions' => [
            'name' => 'api.Sessions',
        ],
    ];

    public function getFirstNameAttribute(): string
    {
        return explode(' ', $this->name ?? '')[0];
    }

    /**
     * Get the providers for the user model.
     *
     * @return HasMany<Provider>
     */
    public function providers(): HasMany
    {
        return $this->hasMany(Provider::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
