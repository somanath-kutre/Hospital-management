<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class labtest extends Model
{
    use HasFactory;

    // use SoftDeletes;

    protected $table = 'labtest';

    protected $fillable = [
        'patient_id',
        'opd_id',
        'admission_id',
        'test_name',
        'category',
        'department',
    ];

    public function patients_clone(){
        return $this->belongsTo(patients_clone::class, 'opd_id');
    }

    public function patients(){
        return $this->belongsTo(patients::class, 'patient_id');
    }
    public function admission(){
        return $this->belongsTo(admission::class, 'admission_id');
    }
}
