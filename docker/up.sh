#!/bin/bash

MIGRATE="${MIGRATE_ENV:0}"

if (( MIGRATE == "1" ))
then
  cd /var/migrate
  vendor/bin/phinx migrate -e development
  while true; do echo PHP Console; sleep 60; done
fi

apache2-foreground