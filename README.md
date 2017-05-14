Health care
===

[![Build Status](https://travis-ci.org/yokoloko/health-care.svg?branch=master)](https://travis-ci.org/yokoloko/health-care)

A symfony project utilizing Docker based on PHP-FPM, nginx, redis and mysql

This project checks weather redis and mysql are running and returns a json.

## Running

You can run the Docker environment using [docker-compose](https://docs.docker.com/compose/):
    $ docker-compose -f docker/docker-compose.yml build
    $ docker-compose -f docker/docker-compose.yml up -d

You can run one-shot command inside the `symfony` service container:

    $ docker-compose -f docker/docker-compose.yml run php composer install
    $ docker-compose -f docker/docker-compose.yml run php php app/console cache:clear
    
You can try it in your browser : `localhost/status/`

To disable `redis` or `mysql`, change the `parameters.yml`

## Tests

Tests can be played

    $ docker-compose -f docker/docker-compose.yml run php vendor/bin/phpunit

