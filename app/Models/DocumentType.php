<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Position;

class DocumentType extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'document_type_id');
    }

    public function document_group()
    {
        return $this->belongsTo(DocumentGroup::class, 'document_group_id');
    }
}
