<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'slug', 'description'
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'project_categories');
    }

    public function medias(){
        return $this->hasMany(Media::class);
    }
}
