<?php


Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    
    Route::get('projects', 'ProjectController@index');
    Route::post('projects', 'ProjectController@insert');
    Route::get('projects/add', 'ProjectController@add');
    Route::get('projects/{id}/edit', 'ProjectController@edit')->name('admin.edit.project');
    Route::patch('projects/{id}', 'ProjectController@update');
    Route::delete('projects/{id}', 'ProjectController@delete');

    Route::delete('medias/{id}', 'ProjectController@deleteImage');

    Route::get('teste', function() {
        $project = App\Models\Project::where('id', 1)->get()-first();
        echo $project->name;
    });


    Route::get('pages', 'PageController@index');
    Route::get('pages/add', 'PageController@add');

    Route::get('/', 'HomeController@index')->name('home');
});


Auth::routes();


