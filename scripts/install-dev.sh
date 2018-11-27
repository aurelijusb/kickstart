#!/usr/bin/env bash

# Make us independent from working directory
pushd `dirname $0` > /dev/null
SCRIPT_DIR=`pwd`
popd > /dev/null

set -e

# Installing dependencies
echo "Preparing PHP dependencies..."
$SCRIPT_DIR/backend.sh composer install
echo "Setting up database..."
$SCRIPT_DIR/backend.sh bin/console doctrine:database:create
$SCRIPT_DIR/backend.sh bin/console doctrine:migrations:migrate --no-interaction
echo ""
echo "Preparing JavaScript/CSS dependencies..."
echo ""
$SCRIPT_DIR/frontend.sh yarn
echo ""
echo "Regenerating frontend files with each source update."
echo 'Wait until you see "DONE Compiled successfully"'
echo "Press CTRL+C to exit from terminal (error message after exiting this way – is known issue #5457)"
echo ""
$SCRIPT_DIR/frontend.sh yarn run encore dev --watch