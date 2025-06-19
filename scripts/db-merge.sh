#!/bin/bash
# merge (import) the dbs on your local filesystem

# shellcheck disable=SC2112

if [ "$1" == '-v' ]; then
  echo verbose mode on...
  shift
  set -x
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
  drush sql-drop -l $1 && gzcat $1.latest.sql.gz | drush sqlc -l $1
}

# main()
cd ..

DBS='ziquid zds pam fl92'
[ $# -gt 0 ] && DBS="$@"

_warning This will replace the following databases: $DBS.'  Have you exported any config changes you need to keep?'

for DB in $DBS; do
  _db_merge "$DB"
done

echo If no errors were present, the db merge has succeeded.'  You may wish to run a build now.'
