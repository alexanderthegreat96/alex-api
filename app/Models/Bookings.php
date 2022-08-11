<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    /**
     * @var string[]
     */

    protected $fillable =
        [
            'user_id',
            'trip_id'
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,'id','user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trip() {
        return $this->belongsTo(Trips::class,'trip_id','id');
    }
}
