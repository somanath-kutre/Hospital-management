<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class summaster extends Model
{
    use HasFactory;

    protected $table = 'summaster';

    protected $fillable = [
        'summary',
        'prescription'
    ];
}