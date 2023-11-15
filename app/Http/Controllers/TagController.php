<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;
    public function __construct(TagService $tagService){
        $this->tagService = $tagService;
    }
    
    public function index()
    {
        $tags = $this->tagService->getTagPaginate();
        return view('admin.tag.tag', ['tags' => $tags]);
    }

    public function create()
    {
        return view('admin.tag.add');
    }

    public function store(Request $request)
    {
        $this->tagService->fillTag($request->all());
        return redirect()->route('tag.index')->with('message', 'Add tag successfully');
    }

    public function show(Tag $tag)
    {
        //
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', ['tag' => $tag]);
    }

    public function update(Request $request, Tag $tag)
    {
        $this->tagService->updateTag($request->all(), $tag);
        return redirect()->route('tag.index')->with('message', 'Update tag successfully');
    }

    public function destroy(Tag $tag)
    {
        $this->tagService->deleteTag($tag);
        return redirect()->route('tag.index')->with('message', 'Delete tag successfully');
    }
}
