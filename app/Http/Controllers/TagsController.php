<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;

class TagsController extends Controller
{


    public function show(Request $request, $tag)
    {
        try {
            $tag = Tag::with('posts', 'projects')->findOrFail($tag);

            $tagsAll = [];

            $posts = $tag->posts;

            list($tag, $tagsAll) = $this->iterateOverPosts($tag, $posts, $tagsAll);

            $projects = $tag->projects;

            list($tag, $tagsAll) = $this->iterateOverProjects($tag, $projects, $tagsAll);

            return view('tags.show', compact('tag', 'posts', 'projects', 'none_found', 'tagsAll'));
        } catch (\Exception $e) {
            return redirect('/');
        }
    }

    /**
     * @param $tag
     * @param $posts
     * @param $tagsAll
     * @return array
     */
    public function iterateOverPosts($tag, $posts, $tagsAll)
    {
        foreach ($posts as $post) {
            list($tag, $tagsAll) = $this->iterateOverTags($tag, $tagsAll, $post);
        }
        return array($tag, $tagsAll);
    }

    /**
     * @param $tag
     * @param $projects
     * @param $tagsAll
     * @return array
     */
    public function iterateOverProjects($tag, $projects, $tagsAll)
    {
        foreach ($projects as $project) {
            foreach ($project->tags as $tag) {
                list($tag, $tagsAll) = $this->iterateOverTags($tag, $tagsAll, $project);
            }
        }
        return array($tag, $tagsAll);
    }

    /**
     * @param $tag
     * @param $tagsAll
     * @param $post
     * @return array
     */
    public function iterateOverTags($tag, $tagsAll, $post)
    {
        foreach ($post->tags as $tag) {
            $tagsAll[$tag->id] = $tag->toArray();
        }
        return array($tag, $tagsAll);
    }
}
