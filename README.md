### GEO IP

Installation

`composer install`

`cp .env.example .env`

set database config

`php bin/console doctrine:migrations:migrate`


URL: `/api/geo/{IP_ADDRESS}`