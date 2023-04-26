<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    /**
     * Get customer who made the reservation
     */
   public function customer() {
       return $this->belongsTo(Customer::class, 'customer_id', 'id');
   }

    /**
     * Get the status of the reservation
     */
    public function status()
    {
        return $this->hasOne(ReservationStatus::class);
    }
}
