<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Media;
use App\Http\Controllers\Slugify;
use App\Http\Requests\ProjectValidationRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(){
        $projects = Project::get();

        return view('admin.projects.list', [
            'projects' => $projects
        ]);
    }

    public function add(){

        $categories = Category::pluck('name', 'id');
        return view('admin.projects.form', [
            'categories' => $categories
        ]);
    }

    public function edit($id){

        $project = Project::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        $medias = Media::where('project_id', $id)->get();
        return view('admin.projects.form', [
            'project' => $project,
            'categories' => $categories,
            // 'medias' => $medias
        ]);
    }

    public function insert(ProjectValidationRequest $request){

        $name = $request->name;
        $slug = SlugifyController::slugify($name);

        $verifySlug = Project::where('slug', $slug)->count();

        if($verifySlug > 0){
            $slug = $slug."_";
        }
        // exit;
        

        $project = new Project();
        $project->name = $name;
        $project->slug = $slug;
        $project->save();


        $categories = $request->categories;
        $project->categories()->sync($categories);

        $nameFile = $request->image;

        foreach ($nameFile as $key => $value) {

            $countMedias = Media::where('project_id', $project->id)->count();

            if($countMedias > 0){
                $countMedias = $countMedias++;
            }
   
            $newName = $slug."_".$countMedias;

            $extension = $value->extension();

            $nameFileSingle = "{$newName}.{$extension}";

            $countMedias = Media::where('filename', $nameFileSingle)->count();
            
            $nameFileSingle = "{$newName}.{$extension}";

            if($countMedias > 0){
                $nameFileSingle = "{$newName}_1.{$extension}";
            }

            $upload = $value->storeAs('public/projects/'. $project->id .'/', $nameFileSingle);

            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();

            $insertImage = $project->medias()->create([
                'filename' => $nameFileSingle,
                'project_id' => $project->id
                ]);
        }

        

        \Session::flash('success', 'Projeto cadastrado com sucesso! 🍻');
        return \Redirect::to('admin/projects');
    }

    public function update($id, ProjectValidationRequest $request){

        $name = $request->name;
        $slug = SlugifyController::slugify($name);

        $verifyName = Project::where('slug', $slug)->count();

        if($verifyName > 0){
            $slug = $slug."_";
        }

        $project = Project::findOrFail($id);
        $project->name = $name;
        $project->slug = $slug;
        $project->update();

        $categories = $request->categories;
        $project->categories()->sync($categories);

        if($request->image != null){
            $nameFile = $request->image;

            foreach ($nameFile as $key => $value) {

                $countMedias = Media::where('project_id', $project->id)->count();

                if($countMedias > 0){
                    $countMedias = $countMedias++;
                }

                $newName = $slug."_".$countMedias;
                $extension = $value->extension();

                $nameFileSingle = "{$newName}.{$extension}";

                $countMedias = Media::where('filename', $nameFileSingle)->count();

                $nameFileSingle = "{$newName}.{$extension}";

                $upload = $value->storeAs('public/projects/'. $id .'/', $nameFileSingle);

                if ( !$upload )
                    return redirect()
                                ->back()
                                ->with('error', 'Falha ao fazer upload')
                                ->withInput();

                $insertImage = $project->medias()->create([
                    'filename' => $nameFileSingle,
                    'project_id' => $project->id
                    ]);
            }
        }

        \Session::flash('success', 'Projeto atualizado com sucesso! 🍻');
        return \Redirect::to('admin/projects');
    }

    public function delete(Request $request){

        $project = Project::findOrFail($request->id);

        $medias = Media::where('project_id', $project->id)->get();
        foreach($medias as $media){
            $file = $media->filename;
            unlink(storage_path("app/public/projects/{$project->id}/{$file}"));
        }

        rmdir(storage_path("app/public/projects/{$project->id}"));

        $project->delete();

        \Session::flash('success', 'Projeto deletado com sucesso! 🍻');
        return \Redirect::to('admin/projects');

    }

    public function deleteImage(Request $request){

        $idMedia = $request->mediaId;
        $media = Media::findOrFail($idMedia);

        $idProject = $media->projects->id;

        $countMedias = Media::where('project_id', $idProject)->count();

        if($countMedias <= 1){
            return \Redirect::route('admin.edit.project', [$idProject])->with('alert', 'O projeto necessita de pelo menos uma imagem.');
            
        }
        // exit;
        unlink(storage_path("app/public/projects/{$idProject}/{$media->filename}"));

        $media->delete();

        \Session::flash('success', 'Imagem deletada com sucesso! 🍻');
        return \Redirect::route('admin.edit.project', [$idProject]);
        

    }
}