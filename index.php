<?php
$dsn = 'mysql:host=localhost;dbname=hh';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка подключения к базе данных: ' . $e->getMessage();
    exit();
}

// Функция для получения информации о пользователе по его ID
function get_user_info($user_id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = ?');
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Функция для создания пользователя
function create_user($user_data) {
    global $pdo;
    
    // Проверка наличия необходимых данных
    if (!isset($user_data['name']) || !isset($user_data['email']) || !isset($user_data['password'])) {
        throw new InvalidArgumentException('Missing name, email, or password in user data');
    }

    // Хэширование пароля
    //$hashed_password = password_hash($user_data['password'], PASSWORD_DEFAULT);
    
    // Подготовка и выполнение SQL-запроса
    $stmt = $pdo->prepare('INSERT INTO users (user_id, name, email, password) VALUES (?, ?, ?, ?)');
    $result = $stmt->execute(["", $user_data['name'], $user_data['email'], $user_data['password']]);

    if ($result) {
        // Возвращение ID нового пользователя
        $user_id = $pdo->lastInsertId();
        return $user_id;
    } else {
        // Если вставка не удалась, бросаем исключение
        throw new Exception('User creation failed');
    }
}

// Функция для обновления информации о пользователе
function update_user_info($user_id, $new_data) {
    global $pdo;
    
    // Проверка наличия необходимых данных
    if (!isset($new_data['name']) || !isset($new_data['email']) || !isset($new_data['password'])) {
        throw new InvalidArgumentException('Missing name or email in new data');
    }
    
    // Подготовка и выполнение SQL-запроса
    $stmt = $pdo->prepare('UPDATE users SET name = ?, email = ?, password = ? WHERE user_id = ?');
    $stmt->execute([$new_data['name'], $new_data['email'], $new_data['password'], $user_id]);
}

// Функция для удаления пользователя
function delete_user($user_id) {
    global $pdo;
    
    // Подготовка и выполнение SQL-запроса
    $stmt = $pdo->prepare('DELETE FROM users WHERE user_id = ?');
    $stmt->execute([$user_id]);
}

// Функция для авторизации пользователя
function authenticate_user($user_data) {
    global $pdo;
    
    // Проверка наличия необходимых данных
    if (!isset($user_data['email']) || !isset($user_data['password'])) {
        throw new InvalidArgumentException('Missing email or password in user data');
    }
    // Подготовка и выполнение SQL-запроса
    $stmt = $pdo->prepare('SELECT user_id, password FROM users WHERE email = ?');
    $stmt->execute([$user_data['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // Проверка пароля
    if ($user['user_id']) {
        if ($user_data['password'] === $user['password']) {
            return $user['user_id'];
        }
    } else {
        return false;
    }
}

// Обработка запросов к API
$method = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch ($method) {
    case 'POST':
        if ($request == '/api/users') {
            try {
                $user_data = json_decode(file_get_contents('php://input'), true);
                $user_id = create_user($user_data);
                echo json_encode(['status' => 'ok', 'user_id' => $user_id]);
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
            } catch (InvalidArgumentException $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } elseif (strpos($request, '/api/users/authenticate') === 0) {
            try {
                $user_data = json_decode(file_get_contents('php://input'), true);
                $user_id = authenticate_user($user_data);
                if ($user_id) {
                    echo json_encode(['status' => 'ok', 'user_id' => $user_id]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
                }
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
            } catch (InvalidArgumentException $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid endpoint']);
        }
        break;
    case 'PUT':
        if (preg_match('/\/api\/users\/(\w+)/', $request, $matches)) {
            try {
                $user_id = $matches[1];
                $user_data = json_decode(file_get_contents('php://input'), true);
                update_user_info($user_id, $user_data);
                echo json_encode(['status' => 'ok']);
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
            } catch (InvalidArgumentException $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid endpoint']);
        }
        break;
    case 'DELETE':
        if (preg_match('/\/api\/users\/(\w+)/', $request, $matches)) {
            try {
                $user_id = $matches[1];
                delete_user($user_id);
                echo json_encode(['status' => 'ok']);
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid endpoint']);
        }
        break;
    case 'GET':
        if (preg_match('/\/api\/users\/(\w+)/', $request, $matches)) {
            try {
                $user_id = $matches[1];
                $user_info = get_user_info($user_id);
                echo json_encode($user_info);
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid endpoint']);
        }
        break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid method']);
}
?>
