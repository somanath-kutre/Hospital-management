<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ipd_clone extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'ipd_clone';

    protected $fillable = [
        'patient_id',
        'opd_number',
        'admission_id',
        'name',
        'admission_type',
    ];

    public function patient(){
        return $this->belongsTo(patients::class, 'patient_id');
    }

    public function admission(){
        return $this->belongsTo(admission::class, 'admission_id');
    }
    public function opd(){
        return $this->belongsTo(patients_clone::class, 'opd_number');
    }
}
