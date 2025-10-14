#!/bin/bash
(crontab -l | grep -v "/usr/bin/php /Applications/MAMP/htdocs/Backend-6amMart/public/artisan dm:disbursement") | crontab -

(crontab -l | grep -v "/usr/bin/php /Applications/MAMP/htdocs/Backend-6amMart/public/artisan store:disbursement") | crontab -

