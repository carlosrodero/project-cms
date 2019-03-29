<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';
    
    protected $fillable = [
        'filename'
    ];

    public function projects(){
        return $this->belongsTo(Project::class, 'project_id');
    }
}
