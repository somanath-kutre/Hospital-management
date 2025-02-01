<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cloned_recipts extends Model
{
    use HasFactory;

    protected $table = 'cloned_recipts';

    protected $fillable = [
        'admission_id',
        'opd_number',
        'amount',
        'p_mode',
        'descr'
    ];

    public function patient(){
        return $this->belongsTo(admission::class);
    }
    public function patient_clone(){
        return $this->belongsTo(patients_clone::class);
    }
}
