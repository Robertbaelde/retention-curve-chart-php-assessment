# Retention curve PHP Assessment
Get insight of how users flow through the onboarding process.

## Docker Development Environment
* Apache/2.4.25 (Debian)
* PHP 7.1.20

## PHPUnit 7.5.15
Via Composer:
* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/RetentionOnboardingTest.php
* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/RetentionDayTest
* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/RetentionWeekTest.php
* ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/RetentionWeeksTest.php