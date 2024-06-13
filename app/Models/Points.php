<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    use HasUlids, HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'coupon',
        'code',
      ];
}
