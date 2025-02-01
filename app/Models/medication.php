<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medication extends Model
{
    use HasFactory;

    protected $table = 'medications';

    protected $fillable = [
        'admission_id',
        'medicine',
        'dosage',
        'strenth'
    ];

    public function patient(){
        return $this->belongsTo(admission::class); 
    }
}
