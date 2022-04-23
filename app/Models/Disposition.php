<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = 'no';

    public $incrementing = false;

    protected $keyType = 'string';

    public function inmail()
    {
        return $this->belongsTo(Inmail::class);
    }

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}
