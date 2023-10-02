#!/bin/bash
# fetch the latest copies of the dbs

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

function _db_fetch() {
  echo
  echo Fetching the $1 db...
  scp ovh4:/var/backup/$1.latest.sql.gz .
}

# main()
cd ..

_mac || _die This command works for macs only.  Sorry.

_db_fetch ziquid
_db_fetch zds
# _db_fetch cheek
_db_fetch pam
_db_fetch glamma
_db_fetch fl92
