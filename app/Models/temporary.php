<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temporary extends Model
{
    use HasFactory;

    protected $table = 'temporary';

    protected $fillable = [
        'admission_id',
        'description',
        'category',
        'amount',
        'admission_type',
        'qty'
    ];

    public function patient(){
        return $this->belongsTo(admission::class);
    }
}
