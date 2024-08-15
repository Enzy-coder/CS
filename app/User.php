<?php

namespace App;

use App\Shipping\UserShippingAddress;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $username
 * @property string|null $email_verified
 * @property string|null $email_verify_token
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $state
 * @property string|null $city
 * @property string|null $zipcode
 * @property string|null $country
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $facebook_id
 * @property string|null $google_id
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|UserShippingAddress[] $shipping
 * @property-read int|null $shipping_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAddress($value)
 * @method static Builder|User whereCity($value)
 * @method static Builder|User whereCountry($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerified($value)
 * @method static Builder|User whereEmailVerifyToken($value)
 * @method static Builder|User whereFacebookId($value)
 * @method static Builder|User whereGoogleId($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereImage($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereState($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUsername($value)
 * @method static Builder|User whereZipcode($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'image',
        'phone',
        'address',
        'country',
        'state',
        'city',
        'zipcode',
        'email_verified',
        'email_verify_token',
        'facebook_id',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_verified' => 'integer'
    ];

    public function shipping(): HasMany
    {
        return $this->hasMany(UserShippingAddress::class);
    }
}
