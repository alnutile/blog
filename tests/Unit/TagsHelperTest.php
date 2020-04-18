<?php

namespace Tests\Unit;

use App\Tag;
use App\TagsHelper;
use TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class TagsHelperTest
 * @package Tests\Unit
 *
 * @coversDefaultClass \App\TagsHelper
 */
class TagsHelperTest extends \TestCase
{
    use TagsHelper, DatabaseTransactions, DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();
        $this->withoutJobs();
    }

    /**
     * @covers ::handleTags
     */
    public function testTagsAsString()
    {
        $project = factory(\App\Project::class)->create();
        $request = \Mockery::mock(\Illuminate\Http\Request::class);
        $request->shouldReceive('get')->andReturn("foo,bar");
        $this->handleTags($project, $request);

        $tag = Tag::where('name', 'foo')->first();
        $this->assertNotNull($tag);
    }

    /**
     * @covers ::handleTags
     */
    public function testTags()
    {
        $project = factory(\App\Project::class)->create();
        $request = \Mockery::mock(\Illuminate\Http\Request::class);
        $request->shouldReceive('get')->andReturn("foo,bar");
        $this->handleTags($project, $request);

        $tag = Tag::where('name', 'foo')->first();
        $this->assertNotNull($tag);
    }
}
