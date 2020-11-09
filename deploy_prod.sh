cd /var/www/symfony_projects/
git pull origin master
php bin/console cache:clear
php bin/console cache:warmup

echo "Successfully deployed"