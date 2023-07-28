<?php
// Параметры для подключения к базе данных
$host = '127.0.0.1';
$username = 'root'; // имя пользователя базы данных
$password = ''; // пароль базы данных
$dbname = 'test_task_register'; // имя базы данных

// Подключение к базе данных
$connection = new mysqli($host, $username, $password, $dbname);

// Проверка наличия ошибок при подключении
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT id, name, phone FROM contacts";
$contacts = array();

// Выполняем запрос с проверкой на успешное выполнение
if ($result = $connection->query($sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $contacts[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'phone' => $row['phone']
            );
        }
    }
    $result->free(); // Освобождаем результаты запроса
} else {
    echo "Error executing query: " . $connection->error;
}

$connection->close();

// Возвращаем список контактов в формате JSON
header('Content-Type: application/json');
echo json_encode($contacts);
?>