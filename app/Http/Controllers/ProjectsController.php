<?php

namespace App\Http\Controllers;

use App\MarkdownExtraParser;
use App\MarkDownHelper;
use App\Post;
use App\Project;
use App\Services\SchedulerAls;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProjectsController extends BaseController {

    use MarkDownHelper;

    public function __construct(MarkdownExtraParser $mk, SchedulerAls $scheduler)
    {
        parent::__construct($mk, $scheduler);
        $this->middleware('auth', array('except' => ['index', 'show']));
    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index(Request $request)
    {
        $projects = Cache::rememberForever('projects', function()
        {
            return Project::all()->sortBy('created_at', null, TRUE);
        });

        $projects->load('tags');

        $project = Project::orderBy("created_at", 'desc')->first();

        if(!$request->isJson()) {
            return View::make('projects.index', compact('projects', 'project'));
        } else {
            return Response::json(array('data' => $projects->toArray(), 'status'=>'success', 'message' => "Projects Index"), 200);
        }
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('projects.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $data = $request->all();

        if($request->file('photo_file_name')) {
            try {

                $contents = file_get_contents($request->file('photo_file_name')->getRealPath());

                Storage::put($request->file('photo_file_name')->getClientOriginalName(), $contents, 'public');
            } catch(\Exception $e) {
                Log::info("Error uploading file " . $e->getMessage());
            }
            $data['photo_file_name'] = $request->file('photo_file_name')->getClientOriginalName();
        }

        //TODO REMOVE name field after imports

        if(empty($data['tags'])) {
            $data['tags'] = 0;
        }

        $data['rendered_body']  = $this->getMarkdownTool()->defaultTransform($data['body']);
        $project = Project::create($data);
        $date = $project->created_at;

        if(Input::get('tags') && count(Input::get('tags')) > 0) {
            //@TODO move into shared method
            $tags = Input::get('tags');

            if($tags) {
                $tags_array = explode(",", $tags);
                foreach($tags_array as $tag) {
                    $t = Tag::where("name", "=", trim($tag))->first();
                    if(!$t) {
                        $t = Tag::create(['name' => trim($tag), 'created_at' => $date, 'updated_at' => $date]);
                    }
                    $project->tags()->attach( (array) $t->id, array('created_at' => $date, 'updated_at' => $date) );
                }
            }
        }

        if($request->format() == 'html') {
            return Redirect::route('projects.index');
        } else {
            return Response::json(array('data' => $project->toArray(), 'status'=>'success', 'message' => "Project Created"), 200);
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{


        $project = Cache::rememberForever('project_' . $id, function() use ($id)
        {
            return Project::find($id)->load('tags');
        });

        $projects = Cache::rememberForever('projects', function()
        {
            return Project::all()->sortBy('created_at', null, TRUE);
        });

        return View::make('projects.show', compact('project', 'projects'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $project = Project::find($id)->load('tags');
        $t = [];
        foreach($project->tags as $tag) {
            $t[] = $tag->name;
        }
        $tags_string = implode(',', $t);
        return View::make('projects.edit', compact('project', 'tags_string'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $project = Project::findOrFail($id);

        $data = $request->all();

        $this->validate($request, Post::$rules);

        if($request->file('photo_file_name')) {

            try {
                $contents = file_get_contents($request->file('photo_file_name')->getRealPath());

                Storage::put($request->file('photo_file_name')->getClientOriginalName(), $contents, 'public');
            } catch(\Exception $e) {
                //dd("Error uploading file " . $e->getMessage());
            }
            $data['photo_file_name'] = $request->file('photo_file_name')->getClientOriginalName();
        } else {
            $data['photo_file_name'] = $project->photo_file_name;
        }
        $project->update($data);
        $project->tags()->detach();
        if(Input::get('tags') && count(Input::get('tags')) > 0) {

            //@TODO move into shared method

            $tags = Input::get('tags');
            $tag_ids = [];

            if($tags) {
                $date = $project->created_at;
                $tags_array = explode(",", $tags);

                foreach($tags_array as $tag) {
                    $t = Tag::where("name", "=", trim($tag))->first();
                    if(!$t) {
                        $t = Tag::create(['name' => trim($tag), 'created_at' => $date, 'updated_at' => $date]);
                    }
                    $project->tags()->attach( (array) $t->id, array('created_at' => $date, 'updated_at' => $date) );
                }
            }
        }

        return Redirect::route('projects.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        Project::destroy($id);

        return Redirect::route('projects.index');
	}

}