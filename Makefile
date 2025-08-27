.PHONY: help dev stop build install clean

help: ## Show this help message
	@echo 'Usage: make [target]'
	@echo ''
	@echo 'Targets:'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  %-15s %s\n", $$1, $$2}' $(MAKEFILE_LIST)

dev: ## Start development environment
	docker-compose up -d
	@echo "WordPress is starting up at http://localhost"
	@echo "PHPMyAdmin available at http://localhost:8080 (use --profile dev)"

stop: ## Stop development environment
	docker-compose down

build: ## Build theme and plugin assets
	./build.sh

install: ## Install all dependencies
	npm install
	cd wp-content/themes/custom && npm install
	cd wp-content/plugins/custom-blocks && npm install

clean: ## Clean up Docker containers and volumes
	docker-compose down -v
	docker system prune -f

logs: ## Show container logs
	docker-compose logs -f

shell: ## Access WordPress container shell
	docker-compose exec wordpress bash

db-backup: ## Backup database
	docker-compose exec db mysqldump -u wordpress -pwordpress wordpress > backup.sql

db-restore: ## Restore database from backup.sql
	docker-compose exec -T db mysql -u wordpress -pwordpress wordpress < backup.sql