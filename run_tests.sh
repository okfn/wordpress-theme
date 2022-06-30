#!/bin/bash
# Search for PHP syntax errors.
find -L . -name '*.php' -print0 | xargs -0 -n 1 -P 4 php -l

# WordPress Coding Standards.
phpcs -p -s -v -n . --standard=./phpcs.xml --extensions=php

# Automatically fix PHP syntax errors.
phpcbf . --standard=./phpcs.xml --extensions=php
