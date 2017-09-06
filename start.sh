#!/bin/bash
PHP_IDE_CONFIG="serverName=companies"
php -dxdebug.remote_autostart=0 artisan serve --host 0.0.0.0