#!/usr/bin/env bash
set -e

docker build -t all_different_directions docker
docker run -it --rm --name all-different-directions -v "$PWD":/var/www all_different_directions composer install



