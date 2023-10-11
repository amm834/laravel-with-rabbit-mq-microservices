#!/usr/bin/env bash


docker-compose exec -t $1 php $1/artisan migrate
