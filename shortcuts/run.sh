#!/usr/bin/env bash
set -e

docker run -it --rm --name all-different-directions -v "$PWD":/var/www  all_different_directions php bin/console.php app:computre:file input.txt