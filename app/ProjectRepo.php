<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProjectRepo
{

    use TagsHelper;

    public function createProject(Model $model, Request $request) {
        if($request->get('tags') && count($request->get('tags')) > 0) {
            $date = $model->created_at;
            //@TODO move into shared method
            $tags = $request->get('tags');

            if($tags) {
                $tags_array = explode(",", $tags);
                foreach($tags_array as $tag) {
                    $t = Tag::where("name", "=", trim($tag))->first();
                    if(!$t) {
                        $t = Tag::create(['name' => trim($tag), 'created_at' => $date, 'updated_at' => $date]);
                    }
                    $model->tags()->attach( (array) $t->id, array('created_at' => $date, 'updated_at' => $date) );
                }
            }
        }

    }

    public function handleUpdate($id, Request $request) {
        $project = Project::findOrFail($id);

        $data = $request->all();

        if($request->file('photo_file_name')) {

            try {
                $contents = file_get_contents($request->file('photo_file_name')->getRealPath());

                Storage::disk("local")->put($request->file('photo_file_name')->getClientOriginalName(), $contents, 'public');
            } catch(\Exception $e) {
                Log::debug(sprintf("Error with image upload %s", $e->getMessage()));

            }
            $data['photo_file_name'] = $request->file('photo_file_name')->getClientOriginalName();
        } else {
            $data['photo_file_name'] = $project->photo_file_name;
        }

        $project->update($data);
        $project->tags()->detach();
        if(Input::get('tags') && count(Input::get('tags')) > 0) {

            //@TODO move into shared method

            $tags = Input::get('tags');
            $tag_ids = [];

            if($tags) {
                $date = $project->created_at;
                $tags_array = explode(",", $tags);

                foreach($tags_array as $tag) {
                    $t = Tag::where("name", "=", trim($tag))->first();
                    if(!$t) {
                        $t = Tag::create(['name' => trim($tag), 'created_at' => $date, 'updated_at' => $date]);
                    }
                    $project->tags()->attach( (array) $t->id, array('created_at' => $date, 'updated_at' => $date) );
                }
            }
        }
    }

}