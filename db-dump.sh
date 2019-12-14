#!/bin/sh
# dump a sanitized copy of the db

function do_dump() {

  echo
  echo Dumping and sanitizing the $1 db...
  echo
  set -x

  # dump the full production db
  drush sql-dump > $1.sql

  # sanitize the full production db
  drush -q sqlsan --sanitize-email=email+%uid@example.com --sanitize-password=no -y

  # dump the sanitized version
  drush sql-dump > $1.san.sql

  # reload the production db and remove the dump on the file system
  drush sqlc < $1.sql
  shred -u $1.sql || rm -P $1.sql || rm $1.sql

  # move the sanitized version to public files and create compressed and downloadable copies
  # (drupal's .htaccess auto-blocks .sql files)
  # also store a backup somewhere
  gzip -c $1.san.sql > web/sites/$1/files/$1.san.sql.gz
  [ -d /var/backup ] && cp web/sites/$1/files/$1.san.sql.gz /var/backup/$1.san.sql.gz-$(date | sed -e 's,[: ],-,g') || echo no /var/backup dir exists!
  mv $1.san.sql web/sites/$1/files/$1.san.sql.ok-to-download

  set +x
}

do_dump ziquid
do_dump zds
