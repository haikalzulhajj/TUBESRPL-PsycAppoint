<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
  use HasUlids, HasFactory;

  protected $fillable = [
    'id',
    'slug',
    'heading',
    'title',
    'preview',
    'content',
    'creator',
    'status',
    'points'
  ];
}
