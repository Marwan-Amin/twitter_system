#!/bin/bash
start=`date +%s`

#### START Cleaning docker environment during development
sudo rm -r twitter_database/
docker rm twitter_app twitter_database twitter_phpmyadmin -f
docker system prune -f
docker image prune -f
docker container prune -f
docker volume prune -f
#### END Cleaning docker environment during development

#### START Builing docker containers -------------------------------

cd twitter && composer install && cd ..
docker-compose up -d
sudo chmod -R 777 twitter_database/
#### END Builing docker containers ---------------------------------

#### START Configuring (twitter_app) microservice ----------------------
while ! docker exec twitter_database mysqladmin --user=root --password=secret --host "127.0.0.1" ping --silent &> /dev/null ; do
    echo "... Waiting for Twitter system's database to be deployed ..."
    sleep 10
done
echo "... Twitter system's database has been deployed successfully ..."

docker exec -it twitter_app chmod -R 777 /var/www/html
docker exec -it twitter_app cp .env.example .env
docker exec -it twitter_app composer dump-autoload
docker exec -it twitter_app php artisan key:generate
docker exec -it twitter_app php artisan migrate:fresh --seed
docker exec -it twitter_app php artisan passport:install --force
# docker exec -it twitter_app php artisan config:cache
# docker exec -it twitter_app php artisan route:cache
#### END Configuring (twitter_app) microservice ----------------------

end=`date +%s`
runtime=$((end-start))
echo "Twitter system is successfully deployed in" $runtime "seconds"