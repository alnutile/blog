<?php namespace App;

use Illuminate\Support\Facades\Cache;

class Post extends BaseModel
{

    // Add your validation rules here
    public static $rules = [
        'title' => 'required',
    ];

    // Don't forget to fill this array
    protected $fillable = ['title', 'name', 'body', 'rendered_body', 'created_at', 'updated_at', 'active', 'scheduled'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @codeCoverageIgnore
     */
    public function tags()
    {
        return $this->belongsToMany(\App\Tag::class);
    }

    /**
     * @codeCoverageIgnore
     */
    public static function boot()
    {
        parent::boot();
        Post::observe(new PostObserver());
    }

    public function search($word)
    {
        $word = '%' . $word . '%';
        return $this
            ->select('title', 'id')
            ->where([
                [
                    'title', 'like', $word
                ],
                [
                    'active', 1
                ]
            ])->orWhere('body', 'like', $word)
            ->orWhere('rendered_body', 'like', $word)->get();
    }


}
