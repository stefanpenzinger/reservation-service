<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'reservations';
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get the status of the reservation
     */
    public function status()
    {
        return $this->belongsTo(ReservationStatus::class, 'status', 'status');
    }
}
