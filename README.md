<h1>О проекте</h1>
<p>Это RESTful API-сервис, разработанный на Laravel, предназначенный для управления товарами и категориями. Также реализована возможность экспорта товаров в Excel с использованием очередей.</p>
<hr>
<h1>Как запустить проект</h1>
<p>Запуск проекта происходит путём запуска <b>docker-compose up -d</b></p>
<p>Я уже подготовил настройку <b>главного env файла</b>. Он находится в файлике <b>.env.example</b>.</p>
<p>Далее стоит перейти в главный контейнер project_app и запустить комманду <b>composer install</b> </p>
<p>Следущий этап это запуск миграций и сидеров <b>php artisan migrate --seed</b></p>
<p>Будут заполнены данные продуктов (200шт) и категорий</p>
<p>С этого же контейнера стоит запускать воркер для очередей <b>php artisan queue:work</b></p>
<hr>
<p>ТЕСТЫ:</p>
<p>запуск теста:  php artisan test --filter=ProductTest</p>
оставлю так-же на всякий случай коллекцию из постмана, если вдруг будет желание использовать его
