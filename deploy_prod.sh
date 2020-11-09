cd /var/www/symfony_projects/
git pull origin master
composer install

php bin/console cache:clear
php bin/console cache:warmup

echo "Successfully deployed"