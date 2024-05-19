<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_id',
        'user_id',
        'start_date',
        'end_date',
        'location',
    ];

    /**
     * Get the car that owns the rent.
     */
    public function getcar()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Get the user that owns the rent.
     */
    public function getuser()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
