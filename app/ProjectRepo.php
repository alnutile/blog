<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProjectRepo
{

    use TagsHelper, FileHelper, MarkDownHelper;

    public function createProject(Request $request)
    {
        $data = $request->all();

        $file_name = $this->handleFile($request, 'photo_file_name');

        if ($file_name) {
            $data['photo_file_name'] = $file_name;
        }

        if (empty($data['tags'])) {
            $data['tags'] = 0;
        }

        $data['rendered_body']  = $this->getMarkdownTool()->defaultTransform($data['body']);

        $project = Project::create($data);

        $this->handleTags($project, $request);

        return $project;
    }

    public function handleUpdate($id, Request $request)
    {
        $project = Project::findOrFail($id);

        $data = $request->all();

        if ($request->file('photo_file_name')) {
            $file_name = $this->handleFile($request, 'photo_file_name');

            if ($file_name) {
                $data['photo_file_name'] = $file_name;
            }
        } else {
            //Keep existing
            $data['photo_file_name'] = $project->photo_file_name;
        }

        $project->update($data);

        $project->tags()->detach();

        $this->handleTags($project, $request);
    }
}
