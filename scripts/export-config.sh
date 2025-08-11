#!/bin/bash
# export ziquid config on OVH4 or local

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

# Linux/non-ubuntu?  sudo to ubuntu
_linux && [ $(whoami) != ubuntu ] && exec sudo su -l ubuntu -s /bin/bash "$FULLNAME" "$@"
# _linux && [ $(whoami) != root ] && exec sudo su -l root -s /bin/bash "$FULLNAME" "$@"

function update() {
  drush cr -l $1 || :
  drush updb -y -l $1
  drush cr -l $1 || :
  drush cex -y sync -l $1 || drush cex -y sync -l $1
}

# main()
cd ..
git fetch

if [ "$1" != "" ]; then
  echo checking out branch $1...
  git checkout $1
  git pull
fi

update ziquid
update zds
update fl92
