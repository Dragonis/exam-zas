#!/bin/bash

php app/console cache:clear --env=prod
php app/console cache:warmup --env=prod

mysql -u root < 00-extra/db/create-empty-database.sql
php app/console doctrine:schema:update --force


