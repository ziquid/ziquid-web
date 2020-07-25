#!/bin/bash
# build ziquid on OVH3 or local

set -xe

# Linux/non-apache?  sudo to apache
[ $(uname) == Linux ] && [ $(whoami) == apache ] && exec sudo su -l apache -s /bin/bash "$0" "$@"

function update() {
  drush cr -l $1 || :
  drush updb -y -l $1
  drush cr -l $1 || :
  [ $(uname) == Linux ] && drush cim -y sync -l $1 || drush cim -y sync --partial -l $1
  drush cr -l $1
  drush cc views -l $1
}

# main()
cd $(dirname "$0")/..
git fetch

if [ "$1" != "" ]; then
  echo checking out branch $1...
  git co $1
  git pull
fi

composer.phar install

update ziquid
update zds

scripts/db-dump.sh
