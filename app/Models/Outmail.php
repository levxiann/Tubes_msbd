<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outmail extends Model
{
    use HasFactory;

    protected $guarded = [
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = 'no';

    public $incrementing = false;

    protected $keyType = 'string';

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function mail_type()
    {
        return $this->belongsTo(MailType::class, 'mail_type_id');
    }
}
