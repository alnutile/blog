<?php

namespace App\Search\Indexes;

use App\Search\Fragments\BooleanFragment;
use App\Search\Fragments\DateFragment;
use App\Search\Fragments\FloatFragment;
use App\Search\Fragments\IntegerFragment;
use App\Search\Fragments\KeywordFragment;
use App\Search\Fragments\PorterStemAnalyzerFragment;
use App\Search\Fragments\StemAnalyzedTextFragment;
use ElasticSearcher\Abstracts\AbstractIndex;
use App\Search\Fragments\TextAndKeywordMappingFragment;

/**
 * Default index.
 */
class DefaultIndex extends AbstractIndex
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'default';
    }

    /**
     * The name used to communicate with the elasticsearch server. Can be used to
     * add a prefix but still use the name to refer to it.
     *
     * @return string
     */
    public function getInternalName()
    {
        return config('elasticsearch.default_index', $this->getName());
    }

    /**
     * {@inheritdoc}
     */
    public function setup()
    {
        $settings = [
            'analysis' => [
                'analyzer' => [
                    'stem' => new PorterStemAnalyzerFragment(),
                ],
            ],
        ];

        $this->setSettings($settings);

        $types = [
            'project' => [
                'properties' => [
                    // Internal ID for Laravel Model. This allows for easy
                    // loading.
                    'id' => new IntegerFragment(),
                    'title' => new TextAndKeywordMappingFragment(),
                    'body' => new TextAndKeywordMappingFragment(),
                    'created_at' => new DateFragment(),
                    'updated_at' => new DateFragment(),
                ],
            ],
            'post' => [
                'properties' => [
                    // Internal ID for Laravel Model. This allows for easy
                    // loading.
                    'id' => new IntegerFragment(),
                    'title' => new TextAndKeywordMappingFragment(),
                    'body' => new TextAndKeywordMappingFragment(),
                    'created_at' => new DateFragment(),
                    'updated_at' => new DateFragment(),
                ],
            ],
        ];

        $this->setTypes($types);
    }
}
