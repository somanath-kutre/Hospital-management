<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patients extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'name',
        'household',
        'phone',
        'age',
        'gender',
        'address',
        'a_date'
    ];

    public function admission()
    {
        return $this->hasMany(admission::class, 'patient_id');
    }
}
