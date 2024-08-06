# REST API для работы с пользователями

## Методы

- `POST /api/users` - Создание пользователя. В теле запроса должен быть объект с данными пользователя.
- `PUT /api/users/:user_id` - Обновление информации о пользователе. В теле запроса должен быть объект с новыми данными пользователя.
- `DELETE /api/users/:user_id` - Удаление пользователя.
- `POST /api/users/authenticate` - Авторизация пользователя. В теле запроса должен быть объект с данными пользователя для авторизации.
- `GET /api/users/:user_id` - Получение информации о пользователе по его ID.

## Примеры запросов

### Создание пользователя

Запрос:

POST /api/users
Content-Type: application/json

{
"name": "Ivan ivanov",
"email": "test@mail.ru"
}


Ответ:

HTTP/1.1 200 OK
Content-Type: application/json

{
"status": "ok",
"user_id": "5f25644e7f07875a57a2d4a5"
}


### Получение информации о пользователе

Запрос:

GET /api/users/5f25644e7f07875a57a2d4a5


Ответ:

HTTP/1.1 200 OK
Content-Type: application/json

{
"user_id": "5f25644e7f07875a57a2d4a5",
"name": "Ivan ivanov",
"email": "test@mail.ru"
}


### Авторизация пользователя

Запрос:

POST /api/users/authenticate
Content-Type: application/json

{
"email": "test@mail.ru",
"password": "password123"
}


Ответ:

HTTP/1.1 200 OK
Content-Type: application/json

{
"status": "ok",
"user_id": "5f25644e7f07875a57a2d4a5"
}


### Обновление информации о пользователе

Запрос:

PUT /api/users/5f25644e7f07875a57a2d4a5
Content-Type: application/json

{
"name": "Jane Doe"
}


Ответ:

HTTP/1.1 200 OK
Content-Type: application/json

{
"status": "ok"
}


### Удаление пользователя

Запрос:

DELETE /api/users/5f25644e7f07875a57a2d4a5


Ответ:

HTTP/1.1 200 OK
Content-Type: application/json

{
"status": "ok"
}

