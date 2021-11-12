install:
	composer install

autoload:
	composer dump-autoload

validate:
	composer validate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

test:
	composer exec --verbose phpunit tests -- --coverage-text

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml
