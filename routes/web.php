<?php
use App\Post;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Thujohn\Rss\Rss;

if (!function_exists('getBody')) {
    function getBody($item, $full)
    {
        if ($item->rendered_body && strpos($item->rendered_body, 'Not Done Yet') == -1) {
            $render = $item->rendered_body;
        } else {
            $render = $item->body;
        }

        return ($full) ? $render : strip_tags(substr($render, 0, 200));
    }
};

Route::get('/', 'StaticController@showHome');
Route::get('/about', 'StaticController@showAbout')->name('about');
Route::get('/products', 'StaticController@showProducts')->name('products');
Route::get('/talks', 'StaticController@showTalks')->name('talks');
Route::get('/learnings', function () {
    return View::make('static.learning');
})->name('learnings');

Route::get('/keys', function () {
    return View::make('static.keys');
});

Route::get('/trainings/laravel', function () {
    return View::make('trainings.laravel');
});

Route::get("search", 'SearchController@search')->name('search_api');

Route::resource('posts', 'PostsController');


Route::resource('portfolio', 'ProjectsController');

Route::resource('projects', 'ProjectsController');

Route::get('tags/{tag_id}', 'TagsController@show');

Route::get("rekognition", "RekognitionController@show")->name("rekognition.show");

Route::get('rss', function () {

    $full = Input::get('full');

    $rss = new Rss();

    $feed = $rss->feed('2.0', 'UTF-8');

    $feed->channel(
        [
            'title' => 'Alfred Nutile RSS',
            'description' => 'Laravel, Angular Practical Solutions',
            'link' => 'https://www.alfrednutile.info/'
        ]
    );

    $items = Post::published()->OrderByCreatedAt()->get();

    foreach ($items as $item) {
        $trimmed = getBody($item, $full);
        $feed->item(
            [
                'title' => $item->title,
                'description|cdata' => $trimmed,
                'link' => url('posts/' . $item->id)
            ]
        );
    }
    return Response::make($feed, 200, ['Content-Type' => 'text/xml']);
});

Route::get('rss_full', function () {

    $rss = new Rss();

    $feed = $rss->feed('2.0', 'UTF-8');

    $feed->channel(
        [
            'title' => 'Alfred Nutile RSS',
            'description' => 'Laravel, Angular Practical Solutions try https://www.alfrednutile.info/rss_full',
            'link' => 'https://www.alfrednutile.info/'
        ]
    );

    $items = Post::Published()->OrderByCreatedAt()->get();

    foreach ($items as $item) {
        $trimmed = getBody($item, true);
        $feed->item(
            [
                'title' => $item->title,
                'description|cdata' => $trimmed,
                'link' => url('posts/' . $item->id)
            ]
        );
    }
    return Response::make($feed, 200, ['Content-Type' => 'text/xml']);
});

Route::get("help", "HelpController@show")->name("help");
Route::get("pdf", "HelpController@pdf")->name("pdf");

Route::auth();

Route::post('register', function () {
    return redirect('login')->withErrors(["email" => "Not allowed to register"]);
});

Route::get('register', function () {
    return redirect('login')->withErrors(["email" => "Not allowed to register"]);
});


Route::get("j2a", "JsonToArrayController@show");

Route::post("j2a", "JsonToArrayController@process");

Route::get("a2j", "ArrayToJsonController@show");

Route::post("a2j", "ArrayToJsonController@process");

Route::get("codenames", "CodenameController@show");

Route::post("codenames", "CodenameController@process");