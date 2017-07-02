<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $tag)
    {
        try {
            $tag = Tag::with('posts', 'projects')->findOrFail($tag);

            $tagsAll = [];

            $posts = $tag->posts;

            foreach ($posts as $post) {
                foreach ($post->tags as $tag) {
                    $tagsAll[$tag->id] = $tag->toArray();
                }
            }

            $projects = $tag->projects;

            foreach ($projects as $project) {
                foreach ($project->tags as $tag) {
                    $tagsAll[$tag->id] = $tag->toArray();
                }
            }

            return view('tags.show', compact('tag', 'posts', 'projects', 'none_found', 'tagsAll'));
        } catch (\Exception $e) {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
