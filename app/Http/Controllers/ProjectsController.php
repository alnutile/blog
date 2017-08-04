<?php

namespace App\Http\Controllers;

use AlfredNutileInc\Incomings\Log;
use App\MarkdownExtraParser;
use App\MarkDownHelper;
use App\Post;
use App\Project;
use App\ProjectRepo;
use App\Services\SchedulerAls;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;


use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProjectsController extends BaseController
{

    use MarkDownHelper;

    public function __construct(MarkdownExtraParser $mk, SchedulerAls $scheduler)
    {
        parent::__construct($mk, $scheduler);
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $projects = Cache::rememberForever('projects', function () {
            return Project::all()->sortBy('created_at', null, true);
        });

        $projects->load('tags');

        $project = Project::orderBy("created_at", 'desc')->first();

        if (!$request->isJson()) {
            return View::make('projects.index', compact('projects', 'project'));
        } else {
            return Response::json(
                ['data' => $projects->toArray(),
                    'status'=>'success',
                    'message' => "Projects Index"
                ],
                200
            );
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
    public function store(Request $request, ProjectRepo $projectRepo)
    {
        try {
            $project = $projectRepo->createProject($request);

            if ($request->format() == 'html') {
                return Redirect::route('projects.index');
            } else {
                return Response::json(
                    ['data' => $project->toArray(),
                        'status'=>'success',
                        'message' => "Project Created"],
                    200
                );
            }
        } catch (\Exception $e) {
            Log::debug($e);
            return back(302)->withInput($request->all());
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


        $project = Cache::rememberForever('project_' . $id, function () use ($id) {
            return Project::find($id)->load('tags');
        });

        $projects = Cache::rememberForever('projects', function () {
            return Project::all()->sortBy('created_at', null, true);
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
        foreach ($project->tags as $tag) {
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
    public function update(Request $request, ProjectRepo $repo, $id)
    {
        $this->validate($request, Post::$rules);

        try {
            $repo->handleUpdate($id, $request);

            return Redirect::route('projects.index');
        } catch (\Exception $e) {
            Log::info($e);
            return back()->withInput($request->input())->withErrors(['could not update project see logs']);
        }
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
