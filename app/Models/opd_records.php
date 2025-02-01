<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class opd_records extends Model
{
    use HasFactory;

    protected $table = 'opd_records';

    protected $fillable = [
        'patient_id',
        'opd_details'
    ];
}
