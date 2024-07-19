#!/usr/bin/make -f

# RUN WHOLE PROCESS IN ONE SHELL
.ONESHELL:

################################################################################
################################################################################
# Variable definitions
################################################################################

# Are we running in an interactive shell? If so then we can use codes for
# a colored output
ifeq ("$(shell [ -t 0 ] && echo yes)","yes")
FORMAT_BOLD=\e[1m
FORMAT_RED=\033[0;31m
FORMAT_YELLOW=\033[0;33m
FORMAT_GREEN=\x1b[32;01m
FORMAT_RESET=\033[0m
else
FORMAT_BOLD=
FORMAT_RED=
FORMAT_YELLOW=
FORMAT_GREEN=
FORMAT_RESET=
endif

# Path to the echo binary. This is needed because on some systems there are
# multiple versions installed and the alias "echo" may reffer to something
# different.
ECHO=$(shell which echo -e)
OSECHOFLAG=-e
UNAME_S := $(shell uname -s)

ifeq ($(UNAME_S),Darwin)
	ECHO=echo
	OSECHOFLAG=
	FORMAT_BOLD=
endif

################################################################################
################################################################################
# Help and tool warmup
################################################################################

# Default target, must be first!
.ONESHELL: default
.PHONY: default
default:
	@$(ECHO) ""
	@$(ECHO) $(OSECHOFLAG)  "$(FORMAT_YELLOW)\n\nCommands:$(FORMAT_RESET)\n\n" \
	"  make start                                             Start Docker containers\n" \
	"  make stop                                              Stop Docker containers\n" \
	"  make sh                                                Log into the main application container\n" \
	"  make test                                              Run tests\n" \
	"  make logs                                              Display all logs (follow mode)\n" \
	"\n" \
	"\n" \

start: ## Start Docker containers
	@$(ECHO) $(OSECHOFLAG) "\n\n$(FORMAT_YELLOW)Starting services$(FORMAT_RESET)\n"
	docker-compose up -d -V --force-recreate --remove-orphans --build
	@$(ECHO) $(OSECHOFLAG) "\n\n$(FORMAT_YELLOW)Application running at http://localhost$(FORMAT_RESET)\n"

stop: ## Stop Docker containers
	@$(ECHO) $(OSECHOFLAG) "\n\n$(FORMAT_YELLOW)Stoping services$(FORMAT_RESET)\n"
	docker-compose down -v

sh: ## Log into the main application container
	@$(ECHO) $(OSECHOFLAG) "\n\n$(FORMAT_YELLOW)Logging into node container$(FORMAT_RESET)\n"
	docker-compose exec app sh

test: ## Install dependencies
	@$(ECHO) $(OSECHOFLAG) "\n\n$(FORMAT_YELLOW)Preparing database$(FORMAT_RESET)\n"
	docker-compose exec -T app sh -c "php artisan test"

logs: ## Display all logs (follow mode)
	@$(ECHO) $(OSECHOFLAG) "\n\n$(FORMAT_YELLOW)Showing all logs$(FORMAT_RESET)\n"
	docker-compose logs -f