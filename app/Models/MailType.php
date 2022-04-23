<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailType extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function inmails()
    {
        return $this->hasMany(Inmail::class, 'mail_type_id');
    }

    public function outmails()
    {
        return $this->hasMany(Outmail::class, 'mail_type_id');
    }
}
