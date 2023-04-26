<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    /**
     * Get all reservations the customer made
     */
    public function reservations() {
        return $this->hasMany(Reservation::Class);
    }
}
