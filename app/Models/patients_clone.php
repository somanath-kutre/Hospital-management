<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class patients_clone extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'patients_clone';

    protected $fillable = [
        'patient_id',
        'admission_id',
        'name',
        'household',
        'phone',
        'age',
        'gender',
        'address',
        'a_date'
    ];

    public function patient(){
        return $this->belongsTo(patients::class, 'patient_id');
    }
    public function admission(){
        return $this->belongsTo(admission::class, 'admission_id');
    }
}
