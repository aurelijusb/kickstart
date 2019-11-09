#!/usr/bin/env bash

# Make us independent from working directory
pushd `dirname $0` > /dev/null
SCRIPT_DIR=`pwd`
popd > /dev/null

docker-compose -f "$SCRIPT_DIR/docker-compose.yml" run \
    --entrypoint=cypress \
    cypress.symfony \
    run \
    --env "BASE_URL=http://nginx.symfony:80"
