.PHONY: all import-sql

all: import-sql

reload-db:
	app/console doctrine:database:drop --force
	app/console doctrine:database:create
	app/console doctrine:migrations:migrate  --no-interaction
	app/console doctrine:fixtures:load --no-interaction
