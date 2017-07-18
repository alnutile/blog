## Going Laravel 5

[![Build Status](https://travis-ci.org/alnutile/alsblog5.svg?branch=mainline)](https://travis-ci.org/alnutile/alsblog5)

## Notes 

Logging can be seen at Incomings.io 

## Todo

Copy over migrations

Make sure gulp is working for production files

Get auth working

Get theme into place

Post working?

Projects working?

Markdown working?

Import data?

Setup AWS for this

Plug RSS Back in

Copy all images over from server to?


Some other providers in app and then see the old Facased
    'Schickling\Backup\BackupServiceProvider',
    'Als\Services\ImageService',
    'Als\ServiceProviders\SearchServiceProvider',
    'Thujohn\Rss\RssServiceProvider'

Façades
    'ImageToUse'      => 'Als\Facades\ImageFacade',
    'SearchAls'       => 'Als\Facades\SearchFacade',
    'Rss' 			  => 'Thujohn\Rss\RssFacade'


## Assets

This is old laravel 4 updated to 5 and those are still in public :(

And gulp right now has not been updated so you need to run 'gulp scripts', 'gulp angular' and or 'gulp css' before pushing to add new updates to production

## Password Reset

php artisan password_reset

## Tests

Might as well hit the resume too

## Todos:

- [ ] Write documentation
- [ ] Write tests
- [ ] Fix linting errors
- [ ] Make sure code coverage hasn't dropped
- [ ] Provide verification config / commands / resources
- [ ] Enable "Allow edits from maintainers" for this PR
- [ ] Update the messages below

***Is this ready for review?:*** NO
***Is it a breaking change?:*** NO

## Deployments

Travis will run tests and code style check the deploy via Forge GET
