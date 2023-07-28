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

// Создание таблицы, если она еще не существует
$sql = "CREATE TABLE IF NOT EXISTS contacts (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL
)";

if ($connection->query($sql) === TRUE) {
    echo "Table 'contacts' created successfully";
} else {
    echo "Error creating table: " . $connection->error;
}

// Получение данных из POST-запроса
$name = $_POST['name'];
$phone = $_POST['phone'];

// Запрос к базе данных для добавления контакта
$sql = "INSERT INTO contacts (name, phone) VALUES ('$name', '$phone')";
$result = $connection->query($sql);

$connection->close();
?>