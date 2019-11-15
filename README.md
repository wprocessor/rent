Task:

Создайте функционал, позволяющий на сайт под управлением WordPress добавлять объекты недвижимости. Каждый объект - Custom post type "Property". Добавить к нему Custom taxonomy "City".

На фронтенде реализовать вывод списка объектов с фильтрацией по City через AJAX. Оформить всё в виде theme (можно с нуля, можно на любой starter-теме, можно child от дефолтной). В архив пожалуйста включите экспортный XML с контентом.

Install:

1. Clone repo
2. Run `composer install`
3. Up db dump - will be provided by email
4. Set env variables `RENT_DB_NAME`, `RENT_DB_USERNAME`, `RENT_DB_PASS` at web server; nginx example: fastcgi_param RENT_DB_NAME [dbname];
5. Import XML data - will be provided by email


