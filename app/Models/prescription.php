<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prescription extends Model
{
    use HasFactory;

    protected $table = 'prescription';

    protected $fillable = ['prescription','admission_id'];

    public function admission()
    {
        return $this->belongsTo(admission::class);
    }
}
