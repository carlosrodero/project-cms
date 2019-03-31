<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlockController extends Controller
{
    protected $fillable = [
        'name',
        'content',
        'type',
        'page_id'
    ];
}
