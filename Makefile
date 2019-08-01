.PHONY: test coverage

test:
	vendor/bin/phpunit

coverage:
	vendor/bin/phpunit --coverage-html=coverage
