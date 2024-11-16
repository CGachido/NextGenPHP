.PHONY: up
up:
	docker compose up -d

.PHONY: install
install:
	docker compose exec -u application:application php composer install

.PHONY: test
test:
	docker compose exec -u application:application php composer test

.PHONY: test-watch
test-watch:
	docker compose exec -u application:application php composer test:watch

.PHONY: sh
sh:
	docker compose exec -u application:application php ash
