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
        "created_at",
        "created_by",
        "updated_at",
        "deleted_at",
    ];
}
