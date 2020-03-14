#!/usr/bin/env bash
set -e

docker run -it --rm --name all-different-directions -v "$PWD":/var/www all_different_directions ./vendor/bin/phpunit -c phpunit.xml



