<?php

namespace App\Search;

use Illuminate\Log\Writer;
use Illuminate\Support\Collection;
use App\Post;

class PostNormalizer implements PostNormalizerInterface
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
    public function normalize(Post $post)
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'body' => $post->body,
            'created_at' => $this->formatDateTimeObject($post->created_at),
            'updated_at' => $this->formatDateTimeObject($post->updated_at),
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
