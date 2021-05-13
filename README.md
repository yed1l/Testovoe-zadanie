# Запуск
* composer install
* cp .env.example .env
* php artisan key:generate
* php artisan migrate
* php artisan db:seed

# Авторизация
<h4>Для того чтобы можно было авторизовываться через логин, нужно в тейте AuthenticatesUsers изменить функцию username, так чтобы она возвращала name. К нему можно обраться из LoginController.</h4>

# Пароль от менеджера
* Login: Manager
* Password: secret
