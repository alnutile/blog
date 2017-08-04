<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Michelf\Markdown;

class MarkdownTest extends BrowserKitTestCase
{
    /**
     * @test
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
