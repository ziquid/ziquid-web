#!/bin/bash
# build ziquid on OVH4 or local

set -xe
cd $(dirname "$0")
DIRNAME=$(pwd -P)
BASENAME=$(basename "$0")
FULLNAME="$DIRNAME/$BASENAME"
UNAME=$(uname)

function _linux() {
  [ $UNAME == Linux ] && return 0
  return 1
}

function _prod() {
  echo $(pwd) | grep -q -s prod$ && return 0
  echo $(pwd) | grep -q -s prod/ && return 0
  return 1
}

# Linux/non-apache?  sudo to apache
# _linux && [ $(whoami) != apache ] && exec sudo su -l apache -s /bin/bash "$FULLNAME" "$@"
# _linux && [ $(whoami) != root ] && exec sudo su -l root -s /bin/bash "$FULLNAME" "$@"

function update() {
  drush cr -l $1 || :
  drush updb -y -l $1
  drush cr -l $1 || :
  drush cim -y sync -l $1 || drush cim -y sync -l $1
  drush cr -l $1
  drush cc views -l $1
  _linux && sudo chown -R www-data:www-data web/sites/$1/files || :
}

# main()
cd ..
git fetch

if [ "$1" != "" ]; then
  echo checking out branch $1...
  git checkout $1
  git pull
fi

composer.phar install

update ziquid
update zds
update cheek
update pam
update glamma
update fl92

_prod && scripts/db-dump.sh
