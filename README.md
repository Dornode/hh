# API Управления Пользователями
Это API предназначено для управления пользователями, включая создание, получение, обновление, удаление и авторизацию пользователей.

- **DB**: Пример базы hh.sql

## Методы

### POST /api/users
**Создание Пользователя**

- **Описание**: Создает нового пользователя на основе переданных данных.
- **Тело запроса**: JSON-объект с полями `name`, `email` и `password`.
- **Ответ**: JSON с полями `status` и `user_id` нового пользователя.

### PUT /api/users/:user_id
**Обновление Информации о Пользователе**

- **Описание**: Обновляет информацию о пользователе с заданным `user_id`.
- **Тело запроса**: JSON-объект с новыми данными пользователя (`name`, `email`, `password`).
- **Ответ**: JSON с полем `status`.

### DELETE /api/users/:user_id
**Удаление Пользователя**

- **Описание**: Удаляет пользователя с указанным `user_id`.
- **Ответ**: JSON с полем `status`.

### POST /api/users/authenticate
**Авторизация Пользователя**

- **Описание**: Проверяет введенные данные и возвращает идентификатор пользователя при успешной авторизации.
- **Тело запроса**: JSON-объект с полями `email` и `password`.
- **Ответ**: JSON с полями `status` и `user_id` при успешной авторизации или `status` и `message` при ошибке.

### GET /api/users/:user_id
**Получение Информации о Пользователе**

- **Описание**: Возвращает информацию о пользователе по его идентификатору `user_id`.
- **Ответ**: JSON-объект с информацией о пользователе или ошибкой.

## Примеры Запросов

### Создание Пользователя

**Запрос:**

```http
POST /api/users
Content-Type: application/json

{
  "name": "Ivan Ivanov",
  "email": "test@mail.ru",
  "password": "securepassword"
}
```

**Ответ:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "status": "ok",
  "user_id": "1"
}
```

### Обновление Информации о Пользователе

**Запрос:**

```http
PUT /api/users/1
Content-Type: application/json

{
  "name": "Ivan Ivanov",
  "email": "ivanov_updated@mail.ru",
  "password": "newpassword"
}
```

**Ответ:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "status": "ok"
}
```

### Удаление Пользователя

**Запрос:**

```http
DELETE /api/users/1
```

**Ответ:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "status": "ok"
}
```

### Авторизация Пользователя

**Запрос:**

```http
POST /api/users/authenticate
Content-Type: application/json

{
  "email": "test@mail.ru",
  "password": "securepassword"
}
```

**Ответ:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "status": "ok",
  "user_id": "1"
}
```

**Ошибка Авторизации:**

```http
HTTP/1.1 401 Unauthorized
Content-Type: application/json

{
  "status": "error",
  "message": "Invalid credentials"
}
```

### Получение Информации о Пользователе

**Запрос:**

```http
GET /api/users/1
```

**Ответ:**

```http
HTTP/1.1 200 OK
Content-Type: application/json

{
  "user_id": "1",
  "name": "Ivan Ivanov",
  "email": "test@mail.ru",
  "password": "securepassword"
}
```
