#!/usr/bin/env bash

# Make us independent from working directory
pushd `dirname $0` > /dev/null
SCRIPT_DIR=`pwd`
popd > /dev/null

REPO=$(git config --get remote.origin.url | sed 's#git@github.com:##' | sed 's#.git##')
COMMIT=$(git rev-parse --verify HEAD)

DOCKER_TAG="docker.pkg.github.com/${REPO}/build-atifacts:cypress-${COMMIT}"

echo "Will put artifacts to: ${DOCKER_TAG}"

docker push docker build ${SCRIPT_DIR}/../tests/e2e/cypress/ -t "$DOCKER_TAG"
