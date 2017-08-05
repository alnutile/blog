## Going Laravel 5

[![Build Status](https://travis-ci.org/alnutile/alsblog5.svg?branch=mainline)](https://travis-ci.org/alnutile/alsblog5)


## Assets

This is old laravel 4 updated to 5 and those are still in public :(

And gulp right now has not been updated so you need to run 'gulp scripts', 'gulp angular' and or 'gulp css' before pushing to add new updates to production

## Password Reset

php artisan password_reset

## Testing

Follow notes [https://alfrednutile.info/posts/209](https://alfrednutile.info/posts/209)

Basically in screen run:

```
Xvfb :0 -screen 0 1280x8000x24 &
```

## Deployments

Travis will run tests and code style check the deploy via Forge GET
