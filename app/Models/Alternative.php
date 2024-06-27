<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 'alternatif',
    ];

    public function calculations()
    {
        return $this->hasMany(Calculation::class);
    }
}
