<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    public function inmails()
    {
        return $this->hasMany(Inmail::class);
    }

    public function outmails()
    {
        return $this->hasMany(Outmail::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
