# Тестовое задание PHP

## Инициализация проекта

1 Запустить команду в корневой директории `docker-compose up -d`

2 Зайти в контейнер с приложением `docker exec -it app bash`

3 Запустить команду для установки зависимостей `composer install`

4 Запустить команду `cp .env.example .env`

5 Запустить команду `php artisan cache:clear && php artisan config:clear && php artisan config:cache`

6 Заупустить команду `php artisan migrate`

7 Заупустить команду `php artisan queue:work`

8 Открыть сайт `http://localhost`

Отправленные сообщения записываются в лог файл storage/logs/laravel.log
