<?php
namespace App;

use GuzzleHttp\Client;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCodeName
{

    /**
     * @var int
     * as of October 29 2017 for the filters I have
     */
    protected $total_pages = 31;

    protected $total_per_response = 20;


    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getName()
    {
        $results = $this->client->request(
            "GET",
            "https://api.themoviedb.org/3/discover/movie",
            [
                'query' => [
                    'page' => $this->getRandomPage(),
                    'sort_by' => 'popularity.asc',
                    "adult" => 0,
                    "original_language" => "en",
                    "vote_count.gte" => 5,
                    "vote_average.lte" => 3,
                    "api_key" => config('services.movie_db.key')
                ]
            ]
        );

        $results = json_decode($results->getBody(), true);

        $results = array_get($results, 'results', []);

        $result = array_get($results, $this->getRandomItemInResults(), null);

        $name = array_get($result, 'title', null);

        return $this->standardizeName($name);
    }

    public function standardizeName($name)
    {
        $name = strtolower($name);
        $name = str_replace(" ", "-", $name);
        return preg_replace("/[^a-z0-9_-]+/i", "", $name);
    }


    protected function getRandomPage()
    {
        return rand(1, $this->total_pages);
    }

    protected function getRandomItemInResults()
    {
        return rand(1, $this->total_per_response);
    }

    protected function setRandomItemInResults($number)
    {
        $this->total_per_response = 1;
    }
}
