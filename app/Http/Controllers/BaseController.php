<?php namespace App\Http\Controllers;

use App\MarkdownExtraParser;
use App\Services\SchedulerAls;
use Illuminate\Support\Facades\View;
use Michelf\Markdown;

/**
 * @codeCoverageIgnore
 */
class BaseController extends Controller
{

    /**
     * @var \Michelf\MarkdownExtra
     */
    public $mk;
    public $tags = [];
    public $scheduler;

    public function __construct(MarkdownExtraParser $mk, SchedulerAls $scheduler)
    {
        $this->mk           = ($mk == null) ? new MarkdownExtraParser() : $mk;
        $this->scheduler    = ($scheduler == null) ? new SchedulerAls() : $scheduler;
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    public function tagSubset($found)
    {
        foreach ($found as $key) {
            $item = $key->load('Tags');
            foreach ($item->tags as $tag) {
                $this->tags[$tag->name] = $tag->name;
            }
        }
    }
}
