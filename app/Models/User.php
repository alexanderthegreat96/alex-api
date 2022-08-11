<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable;

    /**
     * @var string
     */
    protected $tablename = 'users';

    protected $fillable =
        [
            'first_name',
            'last_name',
            'email',
            'password'
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function bookings() {
        return $this->hasManyThrough(Bookings::class,Trips::class,'id','user_id','id');
    }
}
