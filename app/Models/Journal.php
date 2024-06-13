<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
  use HasUlids, HasFactory;

  protected $fillable = [
    'id',
    'slug',
    'title',
    'preview',
    'content',
    'creator'
  ];
}
