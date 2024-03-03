<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'canonical', 'created_by', 'is_active', 'note'
    ];
    public function languages()
    {
        return $this->belongsToMany(PostCatalogue::class, "post_catalogue_languages", "language_id", "post_catalogue_id")
            ->withPivot("name", "canonical", "meta_title", "meta_description", "meta_keyword", "description", "content")->withTimestamps();
    }
}
