### GEO IP

Installation

`composer install`

`cp .env.example .env`

Настроить доступ к БД в файле .env

`php bin/console lexik:jwt:generate-keypair` - генерация ключей

`php bin/console doctrine:migrations:migrate` - миграции

`php bin/console app:create-user <username> <password>` - созданеи пользователя или обновление пароля

Файл openapi.yaml с описание ручек, запросов и ответов