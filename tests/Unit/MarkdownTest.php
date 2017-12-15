<?php

namespace Tests\Unit;

use BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Michelf\Markdown;

/**
 * Class MarkdownTest
 * @package Tests\Unit
 *
 * @coversDefaultClass \App\MarkdownExtraParser
 */
class MarkdownTest extends BrowserKitTestCase
{
    /**
     * @test
     * @covers ::_doFencedCodeBlocks_callback
     */
    public function should_create_markdown()
    {
        $incoming = <<<HEREDOC
# You

## Are

~~~
echo "HERE";
~~~


HEREDOC;
        $mk = new \App\MarkdownExtraParser();

        $results = $mk->defaultTransform($incoming);

        $this->assertContains('prettyprint linenums', $results);
    }
}
