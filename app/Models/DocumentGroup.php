<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentGroup extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function document_types()
    {
        return $this->hasMany(DocumentType::class, 'document_group_id');
    }
}
