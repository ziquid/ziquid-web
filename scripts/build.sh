#!/bin/bash
# build ziquid on OVH3 or local

set -xe
chmod +w web/sites/default
git co master
git pull
composer.phar install
drush updb -y
drush updb -y -l zds
drush cim -y sync --partial
drush cim -y sync -l zds --partial
drush cr
drush cr -l zds
drush cc views
drush cc views -l zds
[ $(uname) == Linux ] && $(dirname "$0")/db-dump.sh
