Порядок установки:
1. cp .env.example .env
2. В .env заполнить данные подключения к БД
3. composer install
4. ./vendor/bin/doctrine orm:schema-tool:create