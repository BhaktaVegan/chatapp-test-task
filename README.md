# 🗨️ ChatApp — Тестовое задание

Чат-приложение на Laravel 12 с REST API, авторизацией и пагинацией чатов.

---

## 🚀 Шаги по деплою

### 📦 Сборка контейнеров

```bash
docker-compose up -d --build
```

### 💻 Вход в контейнер

```bash
docker exec -it laravel_app bash
```

### 📥 Установка зависимостей

```bash
composer install
```

---

## 🛠️ Подготовка базы данных

### 🔄 Применение миграций

```bash
php artisan migrate
```

### 🌱 Наполнение данными (сидеры)

```bash
php artisan db:seed
```

---

## ✅ Тестирование

```bash
./vendor/bin/phpunit --group=Global
```

> ⚠️ Для запуска тестов необходимо создать базу данных `chatapp_testing`  
> Применить команду `GRANT ALL PRIVILEGES ON chatapp_testing.* TO 'default'@'%';` для выдачи прав
> и применить к ней миграции


```bash
php artisan migrate --env=testing
```

---

## 📡 API Роуты

### 🔐 Авторизация

#### Вход
```http
POST /api/login
```
**Параметры:**
- `email` (string)
- `password` (string)

#### Выход
```http
POST /api/logout
```

---

### 💬 Список чатов

```http
GET /api/chats
```

**Параметры запроса:**
- `page` (int) — номер страницы
- `itemsPerPage` (int) — количество чатов на страницу

---

## 🧾 Примечания

- Приложение использует Laravel Sanctum для аутентификации.
- Для ограничения запросов реализован `RateLimiter` (10 RPS на IP).
- Список чатов отсортирован по времени последнего сообщения (новые сверху).

---

