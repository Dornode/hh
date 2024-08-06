API управления пользователями
Это API предназначено для управления пользователями, включая создание, получение, обновление, удаление и авторизацию пользователей.

Методы
POST /api/users
Создание пользователя.

Описание: Создает нового пользователя на основе переданных данных.
Тело запроса: JSON-объект с полями name, email, password.
Ответ: JSON с полями status и user_id нового пользователя.
PUT /api/users/:user_id
Обновление информации о пользователе.

Описание: Обновляет информацию о пользователе с заданным user_id.
Тело запроса: JSON-объект с новыми данными пользователя (name, email, password).
Ответ: JSON с полем status.
DELETE /api/users/:user_id
Удаление пользователя.

Описание: Удаляет пользователя с указанным user_id.
Ответ: JSON с полем status.
POST /api/users/authenticate
Авторизация пользователя.

Описание: Проверяет введенные данные и возвращает идентификатор пользователя при успешной авторизации.
Тело запроса: JSON-объект с полями email и password.
Ответ: JSON с полями status и user_id при успешной авторизации, или status и message при ошибке.
GET /api/users/:user_id
Получение информации о пользователе.

Описание: Возвращает информацию о пользователе по его идентификатору user_id.
Ответ: JSON-объект с информацией о пользователе или ошибкой.
Примеры запросов
Создание пользователя
Запрос:

POST /api/users
Content-Type: application/json

{
  "name": "Ivan Ivanov",
  "email": "test@mail.ru",
  "password": "securepassword"
}
Ответ:

HTTP/1.1 200 OK
Content-Type: application/json

{
  "status": "ok",
  "user_id": "5f25644e7f07875a57a2d4a5"
}
Обновление информации о пользователе
Запрос:

PUT /api/users/5f25644e7f07875a57a2d4a5
Content-Type: application/json

{
  "name": "Ivan Ivanov",
  "email": "ivanov_updated@mail.ru",
  "password": "newpassword"
}
Ответ:

HTTP/1.1 200 OK
Content-Type: application/json

{
  "status": "ok"
}
Удаление пользователя
Запрос:

DELETE /api/users/5f25644e7f07875a57a2d4a5
Ответ:

HTTP/1.1 200 OK
Content-Type: application/json

{
  "status": "ok"
}
Авторизация пользователя
Запрос:

POST /api/users/authenticate
Content-Type: application/json

{
  "email": "test@mail.ru",
  "password": "securepassword"
}
Ответ:

HTTP/1.1 200 OK
Content-Type: application/json

{
  "status": "ok",
  "user_id": "5f25644e7f07875a57a2d4a5"
}
Ошибка авторизации:

HTTP/1.1 401 Unauthorized
Content-Type: application/json

{
  "status": "error",
  "message": "Invalid credentials"
}
Получение информации о пользователе
Запрос:

GET /api/users/5f25644e7f07875a57a2d4a5
Ответ:

HTTP/1.1 200 OK
Content-Type: application/json

{
  "user_id": "5f25644e7f07875a57a2d4a5",
  "name": "Ivan Ivanov",
  "email": "test@mail.ru",
  "password": "securepassword"
}