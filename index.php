<!DOCTYPE html>
<html>
<head>
    <title>Книга контактов</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="add-contact">
            <div class="header">
                <h2>Добавить контакт</h2>
            </div>
            <div class="content">
                <input type="text" placeholder="Имя">
                <input type="text" placeholder="Телефон">
                <div class="button-container">
                    <button id="add-button">Добавить</button>
                </div>
            </div>
        </div>
        <div class="contact-list">
            <div class="header">
                <h2>Список контактов</h2>
            </div>
            <div class="content" id="contact-list-content">
                <?php include 'get_contacts.php'; ?>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>