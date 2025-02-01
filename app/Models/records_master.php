<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class records_master extends Model
{
    use HasFactory;

    protected $table = 'records_master';
    
    protected $fillable = [
        'master'
    ];
}
