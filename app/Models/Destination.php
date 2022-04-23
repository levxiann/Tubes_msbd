<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    public function disposition()
    {
        return $this->belongsTo(Disposition::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
