<?php

namespace Modules\User\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Database\Factories\GuestFactory;
use Modules\User\Observers\GuestObserver;

/**
 * @property int $id,
 * @property string $guest_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property Carbon $created_at
 */
#[ObservedBy(GuestObserver::class)]
class Guest extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_country_code',
        'phone_number'
    ];

    protected $hidden = [
        'phone_country_code',
        'phone_number'
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime'
        ];
    }

    protected static function newFactory(): GuestFactory
    {
        return new GuestFactory();
    }
}
