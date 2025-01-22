# Variables
PHP_SERVICE = php
DOCKER_EXEC = docker exec -it $(PHP_SERVICE)

build:
	docker build $(PHP_SERVICE)

up:
	docker compose up -d

# Install dependencies
install:
	$(DOCKER_EXEC) composer install

autoload:
	$(DOCKER_EXEC) composer dump-autoload

# Run tests
test:
	$(DOCKER_EXEC) vendor/bin/phpunit

# Update dependencies
update:
	$(DOCKER_EXEC) composer update

# Check code style
cs:
	$(DOCKER_EXEC) composer run-script cs

# Fix code style
cs-fix:
	$(DOCKER_EXEC) composer run-script cs-fix

static:
	$(DOCKER_EXEC) vendor/bin/phpstan
