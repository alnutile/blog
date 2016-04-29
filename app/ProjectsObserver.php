<?php namespace App;

use Illuminate\Support\Facades\Cache;

class ProjectsObserver {

    public function saved($model)
    {
        foreach(['projects', 'project'] as $value)
        {
            Cache::forget($value);
        }

        Cache::forget('project_' . $model->id);
    }
}