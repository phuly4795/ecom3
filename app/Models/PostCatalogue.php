<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCatalogue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "id",
        "parent_id",
        "lft",
        "rgt",
        "is_active",
        "level",
        "image",
        "icon",
        "album",
        "order",
        "follow",
        "created_at",
        "created_by",
        "updated_at",
        "deleted_at",
    ];

    public function languages()
    {
        return $this->belongsToMany(Language::class, "post_catalogue_languages", "post_catalogue_id", "language_id")
            ->withPivot("name", "canonical", "meta_title", "meta_description", "meta_keyword", "description", "content")->withTimestamps();
    }

    public function postCatalogueLanguage()
    {
        return $this->hasMany(PostCatalogueLanguage::class, 'post_catalogue_id', 'id');
    }
}
