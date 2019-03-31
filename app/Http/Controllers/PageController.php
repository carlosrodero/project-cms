<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Layout;
use App\Models\Block;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(){

        $pages = Page::get();
        return view('admin.pages.list', [
            'pages' => $pages
        ]);
    }

    public function edit($id){

        $page = Page::findOrFail($id);
        
        $layoutId = $page->layout_id;
        $layout = Layout::findOrFail($layoutId);

        return view('admin.pages.form', [
            'page' => $page,
            'layout' => $layout
        ]);
    }

    public function update(Request $request){

        $pageId = $request->pageId;

        $blocks = Block::where('page_id', $pageId)->get();

        

        foreach ($blocks as $block) {
            $contentInput = 'input-'.$block->id;
            $content = $request->$contentInput;

            $nameInput = 'name-'.$block->id;
            $name = $request->$nameInput;

            $typeInput = 'type-'.$block->id;
            $type = $request->$typeInput;


            


            $blockUpdate = Block::findOrFail($block->id);

            $blockUpdate->content = $content;
            $blockUpdate->update();

        }

        \Session::flash('success', 'Página atualizada com sucesso! 🍻');
        return \Redirect::to('admin/pages/'.$pageId.'/edit');
        
    }
}
