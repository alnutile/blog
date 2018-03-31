<?php

namespace App\Search;

use Illuminate\Log\Writer;
use Illuminate\Support\Collection;
use App\Project;

class ProjectNormalizer implements ProjectNormalizerInterface
{
    /**
     * ES friendly date/time format.
     */
    const DATE_FORMAT = 'Y-m-d\TH:i:s';

    /**
     * @var \Illuminate\Log\Writer
     */
    protected $logger;

    public function __construct(Writer $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize(Project $model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'body' => $model->body,
            'type' => "project",
            'created_at' => $this->formatDateTimeObject($model->created_at),
            'updated_at' => $this->formatDateTimeObject($model->updated_at),
        ];
    }

    /**
     * Formats a date string.
     *
     * @param \DateTimeInterface $date_time
     *
     * @return string
     *   An RFC3339 date string.
     */
    protected function formatDateTimeObject(\DateTimeInterface $date_time = null)
    {
        return isset($date_time) ? $date_time->timestamp : null;
    }
}
