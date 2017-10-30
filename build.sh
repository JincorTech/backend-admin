#!/bin/bash

set -ex
WORKSPACE="jincort/backend-admin"
FPM="jincort/backend-fpm-admin"
TAG="${1}"

docker build -t ${WORKSPACE}:${TAG} -f workspace.production .
docker push ${WORKSPACE}:${TAG}

docker build -t ${FPM}:${TAG} -f admin.production .
docker push ${FPM}:${TAG}