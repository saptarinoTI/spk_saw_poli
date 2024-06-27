<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_id',
        'alternative_id',
        'tahun',
        'value'
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }
}
