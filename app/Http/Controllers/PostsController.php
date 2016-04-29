<?php namespace App\Http\Controllers;


use App\MarkdownExtraParser;
use App\MarkDownHelper;
use App\Post;
use App\Services\SchedulerAls;
use App\Tag;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class PostsController extends BaseController {

    use MarkDownHelper;

    public function __construct(MarkdownExtraParser $mk, SchedulerAls $scheduler)
    {
        parent::__construct($mk, $scheduler);
        $this->middleware('auth', array('except' => ['index', 'show', 'search']));
    }

    public function search()
    {

        $input = Input::get('search');

        $posts = (new Post())->search($input);

        return Response::json(array('data' => $posts->toArray(), 'status'=>'success', 'message' => "Post Search"), 200);

    }

    public function index()
	{
        //Blade::setContentTags('<%', '%>');        // for variables and all things Blade
        //Blade::setEscapedContentTags('<%%', '%%>');   // for escaped data

        if(Auth::user()) {

            $posts = Post::OrderByCreatedAt()->get();

        } else {

            $posts = Cache::rememberForever('posts', function()
            {
                return Post::Published()->OrderByCreatedAt()->get();
            });

        }

        $posts->load('tags');

        if(!Request::isJson()) {
            return View::make('posts.index', compact('posts'));
        } else {
            return Response::json(array('data' => $posts->toArray(), 'status'=>'success', 'message' => "Post Index"), 200);
        }
	}

	/**
	 * Show the form for creating a new post
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('posts.create');
	}

	/**
	 * Store a newly created post in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Post::$rules);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
        //TODO REMOVE name field after imports

        $data['name']           = "Not needed";
        $data['rendered_body']  = $this->getMarkdownTool()->defaultTransform($data['body']);
        $data['scheduled']      = new \Carbon\Carbon();

        if(empty($data['tags'])) {
            $data['tags'] = 0;
        }

        $post = Post::create($data);

        $date = $post->created_at;

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
                    $post->tags()->attach( (array) $t->id, array('created_at' => $date, 'updated_at' => $date) );
                }
            }
        }

        if(Request::format() == 'html') {
            return Redirect::route('posts.index');
        } else {
            return Response::json(array('data' => $post->toArray(), 'status'=>'success', 'message' => "Post Created"), 200);
        }

	}

	/**
	 * Display the specified post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $post = Cache::rememberForever('post_' . $id, function() use ($id)
        {
            return Post::findOrFail($id);
        });

        $posts = Cache::rememberForever('posts_sidebar', function()
        {
            return Post::all()->sortBy("created_at", null, TRUE);
        });

        $active = $post->id;
		return View::make('posts.show', compact('post', 'posts', 'active'));
	}

	/**
	 * Show the form for editing the specified post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Post::find($id)->load('tags');
        $t = [];
        foreach($post->tags as $tag) {
            $t[] = $tag->name;
        }
        $tags_string = implode(',', $t);
		return View::make('posts.edit', compact('post', 'tags_string'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$post = Post::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Post::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
        $data['rendered_body']  = $this->getMarkdownTool()->defaultTransform($data['body']);
		$post->update($data);
        $post->tags()->detach();
        if(Input::get('tags') && count(Input::get('tags')) > 0) {

            //@TODO move into shared method

            $tags = Input::get('tags');
            $tag_ids = [];

            if($tags) {
                $date = $post->created_at;
                $tags_array = explode(",", $tags);

                foreach($tags_array as $tag) {
                    $t = Tag::where("name", "=", trim($tag))->first();
                    if(!$t) {
                        $t = Tag::create(['name' => trim($tag), 'created_at' => $date, 'updated_at' => $date]);
                    }
                    $post->tags()->attach( (array) $t->id, array('created_at' => $date, 'updated_at' => $date) );
                }
            }
        }

		return Redirect::route('posts.show', $post->id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Post::destroy($id);

		return Redirect::route('posts.index');
	}

}