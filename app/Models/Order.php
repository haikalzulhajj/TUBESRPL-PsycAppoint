<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'schedule_pickup';

    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'user_id',
        'pickup_date',
        'pickup_time',
        'category_trash',
        'amount',
        'notes',
        'file_payment',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
