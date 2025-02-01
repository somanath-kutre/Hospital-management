<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certificates_master extends Model
{
    use HasFactory;

    protected $table = 'certificates_master';

    protected $fillable = [
        'med_certificate'
    ];
}