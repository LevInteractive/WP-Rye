# Change to the production domain name.
PROD_DOMAIN = http://<the-production-url.com>

# This will obtain the local/current domain name WP is using.
_CUR_DOMAIN := $(shell wp option get siteurl)

# Create sql directory if it isn't already.
mkdir -p -m 775 sql/

# Save an instance of the database.
save:
	wp search-replace $(_CUR_DOMAIN) $(PROD_DOMAIN)
	wp db export sql/schema.sql
	wp search-replace $(PROD_DOMAIN) $(_CUR_DOMAIN)

# Install the saved instanced of the database.
install:
	wp db import sql/schema.sql
	wp search-replace $(PROD_DOMAIN) $(URL)
	@echo Installed $(URL)

.PHONY: save install
