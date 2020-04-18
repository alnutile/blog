## Going Laravel 5
[![Build Status](https://travis-ci.org/alnutile/blog.svg?branch=master)](https://travis-ci.org/alnutile/blog)

## Assets

Updated to default format of [https://laravel.com/docs/5.4/mix](https://laravel.com/docs/5.4/mix)

`npm run dev`

Just like the docs note or watch

`npm run watch`

Then production for deployment:

coming soon...

## Password Reset

php artisan password_reset

## Testing

Follow notes [https://alfrednutile.info/posts/209](https://alfrednutile.info/posts/209)

Basically in screen run:

```
Xvfb :0 -screen 0 1280x8000x24 &
```

### JS testing

```
npm run tests
```

These are in tests/js

This is using ava right now with help from:

[https://laracasts.com/series/learn-vue-2-step-by-step/episodes/30](https://laracasts.com/series/learn-vue-2-step-by-step/episodes/30)

and

[https://github.com/GrupaZero](https://github.com/GrupaZero)

Lots of examples there

## Deployments

Travis will run tests and code style check the deploy via Forge GET


[ico-travis]: https://img.shields.io/travis/alnutile/alsblog5/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/alnutile/alsblog5.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/alnutile/alsblog5.svg?style=flat-square

[link-travis]: https://travis-ci.org/alnutile/alsblog5
[link-scrutinizer]: https://scrutinizer-ci.com/g/alnutile/alsblog5/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/alnutile/alsblog5


## Layouts

Main
  * Home
  * About
  * Products
  * Talks
  * Posts
  * Projects/Portfolio
  * Tags
App
 * Login in items


## Scraps

```
 live-search-callback="mySearchCallback"
 live-search-item-template="<a href='/posts/@{{result.id}}'>@{{result.title}}</a>"
 live-search-select="fullName"
 live-search-max-result-size="100"
 ng-model="title"


  ng-app="search" ng-controller='SearchController'
```
