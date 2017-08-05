<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait TagsHelper
{

    public function handleTags(Model $model, Request $request)
    {
        if ($request->get('tags') && count($request->get('tags')) > 0) {
            $date = $model->created_at;
            //@TODO move into shared method
            $tags = $request->get('tags');

            if ($tags) {
                $tags_array = explode(",", $tags);
                foreach ($tags_array as $tag) {
                    $t = Tag::where("name", "=", trim($tag))->first();
                    if (!$t) {
                        $t = Tag::create(['name' => trim($tag), 'created_at' => $date, 'updated_at' => $date]);
                    }
                    $model->tags()->attach((array) $t->id, ['created_at' => $date, 'updated_at' => $date]);
                }
            }
        }
    }
}
