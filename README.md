# User Registration — Laravel API + Vue Frontend

Тестовое задание: регистрация пользователя и просмотр профиля.

## Стек

- **Backend:** Laravel 13, модульная структура `app/Modules`, Sanctum, Swagger (L5-Swagger)
- **Frontend:** Vue 3 + Vue Router + Pinia + Axios, модульная структура `src/modules`

## API

| Метод | URL | Описание |
|-------|-----|----------|
| `POST` | `/api/registration` | Регистрация (`email`, `password`, `gender`) |
| `GET` | `/api/profile` | Профиль (Bearer token) |
| `PUT` | `/api/profile` | Обновление профиля |
| `DELETE` | `/api/profile` | Удаление профиля |

Swagger UI: `http://localhost:8000/api/documentation`

## Структура модулей (Backend)

```
app/Modules/User/
  Controllers/   CreateController, ReadController, UpdateController, DeleteController
  Dto/           Create.php, Read.php, Update.php, Delete.php
  Actions/       Create.php, Read.php, Update.php, Delete.php
  Services/      Create.php, Read.php, Update.php, Delete.php
  Models/        User.php
  Routes/        api.php
```

Слой: **Controller → Action → Service → Model**, DTO валидирует/нормализует вход.

## Структура модулей (Frontend)

```
src/modules/user/
  dto/        create.ts, read.ts, update.ts, delete.ts
  services/   create.ts, read.ts, update.ts, delete.ts
  actions/    create.ts, read.ts, update.ts, delete.ts
  components/ RegistrationForm.vue
  views/      RegistrationView.vue, ProfileView.vue
```

## Локальный запуск

### Backend

```bash
cd backend
composer install
copy .env.example .env   # Windows
php artisan key:generate
# убедитесь, что в php.ini включены: extension=zip, extension=pdo_sqlite, extension=sqlite3
php artisan migrate
php artisan l5-swagger:generate
php artisan serve
```

API: `http://localhost:8000`

### Frontend

```bash
cd frontend
npm install
# VITE_API_URL=http://localhost:8000 в .env
npm run dev
```

Откройте `http://localhost:5173`, зарегистрируйтесь — в DevTools → Console будет лог запроса, затем переход на `/profile` с данными из `api/profile`.

## Postman

Импортируйте коллекцию: [`postman/User_Registration_API.postman_collection.json`](postman/User_Registration_API.postman_collection.json)

1. Выполните **Registration** — token сохранится в переменную коллекции  
2. Выполните **Profile**

Для отправки HR: https://t.me/Jeleapps_HR  
(скриншоты Network/Console + ссылка на тест + Postman-коллекция)

## Бесплатный хостинг (рекомендация)

### Оптимальная связка для демо

| Часть | Сервис | Почему |
|-------|--------|--------|
| **Frontend** | [Vercel](https://vercel.com) или [Netlify](https://www.netlify.com) | Бесплатно, свой домен, автодеплой из Git |
| **Backend** | [Render](https://render.com) (Free Web Service) | PHP/Docker, бесплатный tier (засыпает после простоя) |
| **БД** | SQLite на диске Render **или** бесплатный Postgres на Render | Для демо достаточно SQLite / Free Postgres |

Альтернативы бэкенда:

- **[Railway](https://railway.app)** — удобно для Laravel, есть trial-кредиты  
- **[Fly.io](https://fly.io)** — бесплатный allowance, нужен Dockerfile  
- **[Koyeb](https://www.koyeb.com)** — free tier  

Для фронта с кастомным доменом удобнее всего **Vercel / Netlify / Cloudflare Pages**.

### Краткий план деплоя

1. Залить репозиторий на GitHub  
2. Frontend → Vercel: Root Directory = `frontend`, Build = `npm run build`, Output = `dist`, env `VITE_API_URL=https://your-api.onrender.com`  
3. Backend → Render: Root = `backend`, Build = `composer install && php artisan migrate --force && php artisan l5-swagger:generate`, Start = `php artisan serve --host 0.0.0.0 --port $PORT`  
4. В CORS оставить `allowed_origins => ['*']` или указать URL фронта  
5. Подключить бесплатный домен (Vercel/Netlify дают `*.vercel.app` / `*.netlify.app`, свой домен — бесплатно)

> Render Free засыпает ~15 мин без трафика — первый запрос может быть медленным.

## Демонстрация HR

Отправить в Telegram [@Jeleapps_HR](https://t.me/Jeleapps_HR):

1. Скриншот запроса из консоли браузера (registration + profile)  
2. Ссылку на тестовый сайт (фронт)  
3. Postman-проект (`postman/User_Registration_API.postman_collection.json`)  
4. (опционально) ссылку на Swagger `/api/documentation`
