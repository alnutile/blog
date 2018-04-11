<?php

namespace App\Search;

use App\Project;

interface ProjectNormalizerInterface
{

    /**
     * @param \App\Project $project
     *
     * @return array
     */
    public function normalize(Project $project);
}
