<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class admission extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'admission';

    protected $fillable = [
        'patient_id',
        'admission_type',
        'doctor',
        'refer_doc',
        'operation_name',
        'operation_date',
        'fees',
        'discount',
        'paid',
        'p_mode',
        'advance',
        'discharge'
    ];

    public function patient(){
        return $this->belongsTo(patients::class, 'patient_id');
    }
}
