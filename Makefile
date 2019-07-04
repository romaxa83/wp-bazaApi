init: docker-down docker-up api-permissions composer-install doctrine-migrate cp-env

cp-env:
	cp api/.env.example api/.env

docker-up:
	docker-compose up --build -d

docker-down:
	docker-compose down

api-permissions:
	sudo chmod 777 -R api/var

composer-install:
	docker-compose exec api-php-cli composer update

doctrine-diff:
	docker-compose exec api-php-cli php bin/app.php migrations:diff --no-interaction
	sudo chmod 777 -R api/src/Data/Migration

doctrine-migrate:
	docker-compose exec api-php-cli php bin/app.php migrations:migrate --no-interaction

doctrine-down:
	docker-compose exec api-php-cli php bin/app.php migrations:migrate prev