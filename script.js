// Обработчик события после полной загрузки страницы
document.addEventListener('DOMContentLoaded', function () {
    // Загрузка списка контактов при первой загрузке страницы
    loadContacts();
});

// Функция для загрузки списка контактов из базы данных
function loadContacts() {
    // Очищаем список контактов перед загрузкой
    document.querySelector('.contact-list .content').innerHTML = '';

    // Запрос к серверу для получения списка контактов
    fetch('get_contacts.php') // Замените на свой PHP-файл, который вернет список контактов в формате JSON
        .then(response => response.json())
        .then(data => {
            data.forEach(contact => {
                addContactToList(contact.id, contact.name, contact.phone);
            });
        })
        .catch(error => console.error('Error fetching contacts:', error));
}

// Функция для добавления контакта в базу данных
function addContact(name, phone) {
    // Запрос к серверу для добавления контакта
    fetch('add_contact.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name: name, phone: phone })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Можете выводить ответ от сервера в консоль
        loadContacts(); // Обновляем список контактов на странице
    })
    .catch(error => console.error('Error adding contact:', error));
}

// Функция для удаления контакта из базы данных
function deleteContact(id) {
    // Запрос к серверу для удаления контакта
    fetch('delete_contact.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Можете выводить ответ от сервера в консоль
        loadContacts(); // Обновляем список контактов на странице
    })
    .catch(error => console.error('Error deleting contact:', error));
}

// Функция для добавления контакта в список на странице
function addContactToList(id, name, phone) {
    const contactListContent = document.querySelector('.contact-list .content');
    const contactItem = document.createElement('div');
    contactItem.classList.add('contact-item');
    contactItem.innerHTML = `
        <div class="content-box">
            <div class="name">${name} <span class="delete-icon" onclick="deleteContact(${id})">✖</span></div>
            <div class="phone">${phone}</div>
        </div>
    `;
    contactListContent.appendChild(contactItem);
}

// Обработчик нажатия кнопки "Добавить"
document.getElementById('add-button').addEventListener('click', function () {
    const nameInput = document.querySelector('.add-contact input[placeholder="Имя"]');
    const phoneInput = document.querySelector('.add-contact input[placeholder="Телефон"]');
    const name = nameInput.value;
    const phone = phoneInput.value;

    if (name && phone) {
        addContact(name, phone);

        // Очищаем поля ввода после добавления контакта
        nameInput.value = '';
        phoneInput.value = '';
    }
});