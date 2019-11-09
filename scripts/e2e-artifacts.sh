#!/usr/bin/env bash

# Make us independent from working directory
pushd `dirname $0` > /dev/null
SCRIPT_DIR=`pwd`
popd > /dev/null


echo $(git config --get remote.origin.url)
REPO=$(git config --get remote.origin.url | sed 's#https://github.com/##')
COMMIT=$(git rev-parse --verify HEAD)
DOCKER_TAG="docker.pkg.github.com/${REPO}/build-atifacts:cypress-${COMMIT}"
echo "$COMMIT"
echo "$REPO"
echo "$DOCKER_TAG"

echo "Will put artifacts to: ${DOCKER_TAG}"

#docker build -t "$DOCKER_TAG" ${SCRIPT_DIR}/../tests/e2e/cypress/
#docker push "$DOCKER_TAG"
