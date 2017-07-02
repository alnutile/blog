#!/bin/bash

if [ "$TRAVIS_BRANCH" == "master" ]; then
  curl -k X GET https://forge.laravel.com/servers/103/sites/172679/deploy/http?token=${TOKEN}
fi
