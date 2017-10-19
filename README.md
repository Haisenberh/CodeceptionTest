# CodeceptionTest

##Installation

###Composer

    php composer.phar require "codeception/codeception"


###Phar

Download http://codeception.com/codecept.phar 

Copy it into your project.

Run CLI utility:

    *php codecept.phar*

After you successfully installed Codeception, run this command: 

    codecept bootstrap

###Faker

To generate random test values we use Faker. Faker is a PHP library that generates fake data for you.

Installation:

    composer require fzaninotto/faker

###RUN

To run all api tests:
    
    codecept run api   (from root folder)

To run single test:

    codecept run api tests/api/ShopCest.php

#####Verbosity modes:

    codecept run -v:

    codecept run --steps: print step-by-step execution

    codecept run -vv:

    codecept run --debug: print steps and debug information

    codecept run -vvv: print internal debug information