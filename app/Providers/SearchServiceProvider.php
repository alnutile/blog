<?php namespace App\Providers;

use App\Post;
use App\Repositories\SearchRepository;
use App\Search\Search;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('SearchAls', function () {
            return new Search(new SearchRepository(new Post()));
        });
    }
}
