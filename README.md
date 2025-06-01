<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Блог-платформа на Laravel

Это учебный проект, реализующий блог-платформу с возможностью регистрации, публикации постов, лайков, поиска, профилей пользователей и административной панели.

---

## Основные возможности

- Регистрация и авторизация пользователей
- Профиль пользователя с аватаром
- Лента постов с лайками и просмотром медиа
- Визуальный редактор Summernote для создания и редактирования постов
- Загрузка изображений к постам
- Поиск по постам и пользователям
- Админка с возможностью удаления постов
- Генерация тестовых пользователей и постов через сидеры

---

## Требования

- PHP 8.1+
- Composer
- Node.js и npm (для сборки ассетов)
- MySQL или другая поддерживаемая база данных

---

## Установка и запуск

1. **Клонируйте репозиторий:**
    ```sh
    git clone git@github.com:isilencegrass/grachev_project-laravel.git
    cd grachev_project-laravel
    ```

2. **Установите зависимости:**
    ```sh
    composer install
    npm install
    ```

3. **Скопируйте и настройте `.env`:**
    ```sh
    cp .env.example .env
    ```
    Укажите параметры подключения к базе данных (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4. **Сгенерируйте ключ приложения:**
    ```sh
    php artisan key:generate
    ```

5. **Выполните миграции и сидеры:**
    ```sh
    php artisan migrate:fresh --seed
    ```
    Это создаст таблицы и добавит тестовых пользователей и посты.

6. **Соберите ассеты:**
    ```sh
    npm run build
    ```
    Для разработки используйте:
    ```sh
    npm run dev
    ```

7. **Запустите локальный сервер:**
    ```sh
    php artisan serve
    ```
    Откройте [http://localhost:8000](http://localhost:8000) в браузере.

---

## Вход в административную панель

1. Перейдите по адресу `/admin` (например, http://localhost:8000/admin)
2. После входа доступна возможность удаления постов.

---

## Генерация тестовых данных

- Количество пользователей и постов настраивается в `database/seeders/DatabaseSeeder.php`.
- Для повторной генерации выполните:
    ```sh
    php artisan migrate:fresh --seed
    ```

---

## Основные команды

- Установка зависимостей:  
  `composer install`  
  `npm install`
- Миграции и сидеры:  
  `php artisan migrate:fresh --seed`
- Сборка ассетов:  
  `npm run build` или `npm run dev`
- Запуск сервера:  
  `php artisan serve`

---

## Примечания

- Для загрузки аватаров и изображений убедитесь, что папка `storage` доступна для записи:
    ```sh
    php artisan storage:link
    ```
- Если не отображаются иконки — проверьте подключение Bootstrap Icons в layout.

---

## О Laravel

Laravel — это современный web-фреймворк с выразительным и элегантным синтаксисом. Он облегчает разработку, предоставляя удобные инструменты для работы с маршрутизацией, ORM, миграциями, очередями и многим другим. Подробнее: [Laravel Documentation](https://laravel.com/docs).

---

**Сайт временно доступен по ссылке http://ebg2017g.beget.tech**
**Проект подготовлен для учебной и демонстрационной защиты.**
