#! /bin/bash
# 生成 PHP 文档
php ./storage/sami/sami.phar update ./storage/sami/config.php
# 生成 Api Doc 文档
php artisan system:doc api
# 基本语法错误保障
./vendor/bin/phplint -c ./vendor/poppy/framework/.phplint.yml
# 单元测试
./vendor/bin/phpunit --testsuit configuration
# 错误格式修复
php-cs-fixer fix --config=./vendor/poppy/framework/.php_cs --diff --verbose --diff-format=udiff --dry-run > ./rule.diff
# 自定义的规则匹配
php artisan system:inspect >> ./rule.diff