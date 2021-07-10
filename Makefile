install:
	composer install

autoload:
	composer dump-autoload

validate:
	composer validate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

gendiff:
	./bin/gendiff -h