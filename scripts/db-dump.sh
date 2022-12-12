#!/bin/bash
# dump a (sanitized?) copy of the db

# shellcheck disable=SC2112

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

function do_dump_san() {

  echo
  echo Dumping and sanitizing the $1 db...
  echo
  set -x

  # clear cache then dump the full production db
  drush cr -l $1
  drush sql-dump -l $1 > $1.sql

  # sanitize the full production db
  drush -q sqlsan --sanitize-email=email+%uid@example.com --sanitize-password=no -y -l $1

  # dump the sanitized version
  drush sql-dump -l $1 | grep -v '^INSERT.INTO..cache_container..VALUES' | \
    sed -e 's,utf8mb4_0900_ai_ci,utf8mb4_general_ci,g' > $1.san.sql

  # reload the production db and remove the dump on the file system
  drush sqlc -l $1 < $1.sql
  shred -u $1.sql || rm -P $1.sql || rm $1.sql

  # move the sanitized version to public files and create compressed and downloadable copies
  # (drupal's .htaccess auto-blocks .sql files)
  # also store a backup somewhere
  gzip -c $1.san.sql > web/sites/$1/files/$1.san.sql.gz

  if [ -d /var/backup ]; then
    BACKUP_FILE=$1.san.sql.gz-$(date | sed -e 's,[: ],-,g')
    cp web/sites/$1/files/$1.san.sql.gz /var/backup/$BACKUP_FILE
    ln -sf /var/backup/$BACKUP_FILE /var/backup/$1.latest.sql.gz
  else
    echo no /var/backup dir exists!
  fi

  mv $1.san.sql web/sites/$1/files/$1.san.sql.ok-to-download

  set +x
}

function do_dump() {

  echo
  echo Dumping the $1 db...
  echo
  set -x

  # clear cache then dump the full db
  drush cr -l $1
  drush sql-dump -l $1 | grep -v '^INSERT.INTO..cache_container..VALUES' | \
    sed -e 's,utf8mb4_0900_ai_ci,utf8mb4_general_ci,g' > $1.sql

  set +x
}

# main()
cd ..

[ $(uname) == Linux ] && DUMP=do_dump_san || DUMP=do_dump
$DUMP ziquid
$DUMP zds
$DUMP cheek
$DUMP pam
$DUMP glamma
$DUMP fl92
