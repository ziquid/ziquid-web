#!/bin/sh
# dump a sanitized copy of the db

set -x

# dump the full production db
drush sql-dump > ziquid.sql

# sanitize the full production db
drush sqlsan --sanitize-email=email+%uid@example.com --sanitize-password=no -y

# dump the sanitized version
drush sql-dump > ziquid.san.sql

# reload the production db and remove the dump on the file system
drush sqlc < ziquid.sql
rm ziquid.sql

# move the sanitized version to public files and create compressed and downloadable copies
# (drupal's .htaccess auto-blocks .sql files)
gzip -c ziquid.san.sql > web/sites/default/files/ziquid.san.sql.gz
mv ziquid.san.sql web/sites/default/files/ziquid.san.sql.ok-to-download
