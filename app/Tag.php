<?php namespace App;

/**
 * Class Tag
 * @package App
 * @codeCoverageIgnore
 * NOTE until needed ignored since not special work in here
 */
class Tag extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['name', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany(\App\Post::class);
    }

    public function projects()
    {
        return $this->belongsToMany(\App\Project::class);
    }
}
