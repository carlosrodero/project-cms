<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function delete($id){
        $media = Media::findOrFail($id)->get()->first();

        echo $media->project->name;

        unlink(storage_path("app/public/projects/{$project->id}/{$file}"));

        $media->delete();

        \Session::flash('success', 'Imagem deletada com sucesso! 🍻');
        return \Redirect::to('admin/projects');
    }
}
