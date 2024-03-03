<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCatalogueLanguage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'post_catalogue_id',
        'language_id',
        'name',
        'is_active',
        'description',
        'content',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'canonical',
        'created_at',
        'created_by',
        'updated_at',
        'deleted_at',
        
    ];

    public function postCatalogue()
    {
        return $this->belongsTo(PostCatalogue::class, 'id', 'post_catalogue_id');
    }
}
