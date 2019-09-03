# Retention curve PHP Assessment
Get insight of how users flow through the onboarding process.

## Docker Development Environment
* Apache/2.4.25 (Debian)
* PHP 7.1.20

## Installation
- Clone this repository on your local computer (Virtual hosting or WWW directory). 
- Run the docker-compose up -d
- You can access it via http://localhost (or your virtual host)

## PHPUnit 7.5.15
Via Composer:
* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/RetentionOnboardingTest.php
* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/RetentionDayTest
* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/RetentionWeekTest.php
* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/RetentionWeeksTest.php

* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/CsvDataManagerTest.php
* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/DbDataManagerTest.php
* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/ContextTest.php

* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/RestTest.php
* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/SorterWeeklyRetentionCurveTest.php


## Endpoints
* /private-api/get/retention-curve/weekly-cohorts

Error message in case of no token is send to api.
Error message in case of wrong endpoint.