#!/bin/bash
# merge (import) the dbs on your local filesystem

# shellcheck disable=SC2112

if [ "$1" == '-v' ]; then
  echo verbose mode on...
  shift
  set -xe
fi

cd $(dirname "$0")
DIRNAME=$(pwd -P)
BASENAME=$(basename "$0")
FULLNAME="$DIRNAME/$BASENAME"
UNAME=$(uname)

function _linux() {
  [ $UNAME == Linux ] && return 0
  return 1
}

function _mac() {
  [ $UNAME == Darwin ] && return 0
  return 1
}

function _prod() {
  echo $(pwd) | grep -q -s prod$ && return 0
  echo $(pwd) | grep -q -s prod/ && return 0
  return 1
}

function _die() {
  echo "$*" >&2
  exit 1
}

function _warning() {
  echo WARNING: "$*"
  echo -n If you are sure, hit ENTER to continue or ^C to abort:' '
  read a
  [ $? -ne 0 ] && _die aborted...
}

function _db_merge() {
  if [ ! -r $1.latest.sql.gz ]; then
    echo $1.latest.sql.gz not found!  Cannot import this db.
    return
  fi

  echo Importing the $1 db...
  drush sql-drop -l $1
  gzcat $1.latest.sql.gz | drush sqlc -l $1
}

# main()
cd ..

_warning This will replace all running databases.'  Have you exported any config changes you need to keep?'

_db_merge ziquid
# _db_merge zds
# _db_merge cheek
# _db_merge pam
# _db_merge glamma
_db_merge fl92

echo If no errors were present, the db merge has succeeded.'  You may wish to run a build now.'
