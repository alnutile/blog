<?php namespace App;

use Illuminate\Support\Facades\Cache;

class Post extends BaseModel {

	// Add your validation rules here
	public static $rules = [
		'title' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['title', 'name', 'body', 'rendered_body', 'created_at', 'updated_at', 'active', 'scheduled'];

    public function tags()
    {
        return $this->belongsToMany(\App\Tag::class);
    }

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
            ->where('title', 'like', $word)->orWhere('body', 'like',  $word)
            ->orWhere('rendered_body', 'like',  $word)->get();
    }

    public static function allActive()
    {
        $actives = self::where('active', '=', 'true')->orderBy('created_at', 'desc')->get();
        return $actives;

    }

}