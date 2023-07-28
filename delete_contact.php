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

// Получение данных из POST-запроса
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

// Запрос к базе данных для удаления контакта
$sql = "DELETE FROM contacts WHERE id = $id";
if ($connection->query($sql) === TRUE) {
    // Отправляем успешный JSON-ответ
    echo json_encode(array('message' => 'Contact deleted successfully'));
} else {
    // Отправляем JSON-ответ с ошибкой
    echo json_encode(array('error' => 'Error deleting contact: ' . $connection->error));
}

$connection->close();
?>