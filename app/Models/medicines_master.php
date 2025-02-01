<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicines_master extends Model
{
    use HasFactory;

    protected $table = 'medicines_master';

    protected $fillable = [
        'brand_name',
        'molecule', 'dosage_form', 'category'
    ];
}
