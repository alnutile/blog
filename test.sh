#!/bin/bash

if [[ "$TRAVIS_BRANCH" == 'master' && "$TRAVIS_COMMIT_MESSAGE" != *'[update]'* ]]; then
  echo "Master"
  echo $TRAVIS_BRANCH
  echo $TRAVIS_COMMIT_MESSAGE
else
  echo "Update"
  echo $TRAVIS_BRANCH	
  echo $TRAVIS_COMMIT_MESSAGE
fi
