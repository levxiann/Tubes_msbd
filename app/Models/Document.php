<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
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

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }
}
