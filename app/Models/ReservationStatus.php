<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReservationStatus extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $table = 'reservation_status';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'status';

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'yyyy-MM-dd hh:mm:ss';

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
