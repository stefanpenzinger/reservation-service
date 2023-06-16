<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get the status of the reservation
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(ReservationStatus::class, 'status', 'status');
    }
}
