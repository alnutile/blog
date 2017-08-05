<?php

namespace Tests\Browser;

use Tests\CreatesApplication;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HappyPathTest extends DuskTestCase
{
    use CreatesApplication;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Alfred')
                ->assertSee("building RESTful APIs in Laravel")
                ->clickLink("About")
                ->assertSee("Software Writer and System Architect")
                ->assertSee("Laravel 5.x Cookbook")
                ->clickLink("Portfolio")
                ->assertSee("Tags")
                ->clickLink("Blog & Things")
                ->assertSee("DevelopersHangout")
                ->assertSee("Contact")
                ->assertSee("413-345-5103")
                ->assertSee("Articles")
                ->type("search", "Laravel")
                ->clickLink("Products")
                ->assertSee("Laravel Recipe Book")
                ->assertSee("DevelopersHangout")
                ->clickLink("Resource")
                ->assertSee("ust wanted to stash here many of the books read")
                ->clickLink("Talks")
                ->assertSee("Nerd Summit")
                ->assertSee("PodCast")
            ;
        });
    }


}
