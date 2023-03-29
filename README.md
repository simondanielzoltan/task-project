<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<p align="center"><a href="https://vuejs.org" target="_blank" rel="noopener noreferrer"><img width="100" src="https://vuejs.org/images/logo.png" alt="Vue logo"></a></p>

## Description
It is a demo project with Laravel backend and Vue.js frontend.

## Configure
0. ```console
    alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
    ```
1. ```console
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
    ```
2. ```console
    cp .env.example .env
    ```
3. ```console
    sail up -d
    ```
4. ```console
    npm i
    ```
5. ```console
    sail artisan key:generate
    ```
6. ```console
    sail artisan migrate
7. ```console
    sail artisan db:seed --class=DatabaseSeeder
    ```
8. ```console
    sail artisan serve
    ```
9. ```console
    npm run dev
    ```

## License

[MIT](https://opensource.org/licenses/MIT)