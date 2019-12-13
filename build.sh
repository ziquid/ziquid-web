#!/bin/sh
# build ziquid on OVH3

git co master
git pull
drush updb -y
drush updb -y -l zds
drush cim -y sync
drush cim -y sync -l zds
drush cr
drush cr -l zds
