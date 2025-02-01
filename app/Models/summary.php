<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class summary extends Model
{
    use HasFactory;

    protected $table = 'summary';

    protected $fillable = [
        'admission_id',
        'summary'
    ];

    public function discharge(){
        $this->belongsTo(admission::class);
    }
}
