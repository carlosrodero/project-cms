<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function layouts(){
        return $this->belongsTo(Layout::class);
    }

    public function blocks(){
        return $this->hasMany(Block::class);
    }
}
