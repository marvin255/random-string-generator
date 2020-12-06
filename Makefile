#!/usr/bin/make

user_id := $(shell id -u)
docker_compose_bin := $(shell command -v docker-compose 2> /dev/null) --file "Docker/docker-compose.yml"
php_container_bin := $(docker_compose_bin) run --rm -u "$(user_id)" "php"

.PHONY : help build install shell fixer test
.DEFAULT_GOAL := build

# --- [ Development tasks ] -------------------------------------------------------------------------------------------

build: ## Build container and install composer libs
	$(docker_compose_bin) build --force-rm

install: ## Install all data
	$(php_container_bin) composer install

shell: ## Runs shell in container
	$(php_container_bin) bash

fixer: ## Run fixer to fix code style
	$(php_container_bin) vendor/bin/php-cs-fixer fix -v

linter: ## Run linter to check project
	$(php_container_bin) vendor/bin/php-cs-fixer fix --config=.php_cs.dist -v --dry-run --stop-on-violation
	$(php_container_bin) vendor/bin/phpcpd ./ --exclude vendor --exclude tests --exclude Entity --exclude var -v
	$(php_container_bin) vendor/bin/psalm --show-info=true

test: ## Run tests
	$(php_container_bin) vendor/bin/phpunit run --configuration phpunit.xml.dist