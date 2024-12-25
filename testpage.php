<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Management</title>
    <style>
        /* Основные стили */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .tabs {
            display: flex;
            margin-bottom: 20px;
        }

        .tabs button {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .tabs button:hover {
            background-color: #2980b9;
        }

        .content {
            width: 80%;
        }

        .test-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .test-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .test-item img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .test-item h3 {
            margin: 0;
            font-size: 1rem;
        }

        /* Модальное окно */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            width: 600px;
            text-align: left;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .question {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .question input {
            flex-grow: 1;
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .remove-question-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
        }

        .test-settings {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .test-settings img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        #save-test-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        #save-test-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <main class="main-content">
        <!-- Табы -->
        <div class="tabs">
            <button>Статистика</button>
            <button>Настройка тестов</button>
            <button>Интеграция</button>
        </div>

        <!-- Список тестов -->
        <section class="content">
            <div class="test-container">
                <div class="test-item">
                    <img src="donut-icon.png" alt="Donut Test">
                    <h3>Satisfaction Testing</h3>
                </div>
                <div class="test-item">
                    <img src="brush-icon.png" alt="Brush Test">
                    <h3>Employee Survey</h3>
                </div>
                <div class="test-item">
                    <button>+ Add Test</button>
                </div>
            </div>
        </section>
    </main>

    <!-- Модальное окно -->
    <div id="test-details-modal" class="modal">
        <div class="modal-content">
            <button class="close-btn">&times;</button>
            <h2 id="test-name">Name test</h2>
            <p id="test-description">Description about test</p>

            <!-- Вопросы -->
            <div id="questions-container">
                <div class="question">
                    <input type="text" value="What do you think about new poster?" readonly>
                    <button class="remove-question-btn">&times;</button>
                </div>
                <div class="question">
                    <input type="text" value=" " readonly>
                    <button class="remove-question-btn">&times;</button>
                </div>
                <div class="question">
                    <input type="text" value=" " readonly>
                    <button class="remove-question-btn">&times;</button>
                </div>
                <div class="question">
                    <input type="text" value=" " readonly>
                    <button class="remove-question-btn">&times;</button>
                </div>
            </div>

            <!-- Настройки -->
            <div class="test-settings">
                <img src="donut-icon.png" alt="Test Icon">
                <div>
                    <h3>Name test</h3>
                    <p>Description</p>
                    <label>
                        <input type="checkbox" id="test-toggle">
                        <span>Enable test</span>
                    </label>
                </div>
            </div>

            <!-- Кнопка сохранения -->
            <button id="save-test-btn">Save</button>
        </div>
    </div>

    <script>
        // Элементы
        const testModal = document.getElementById('test-details-modal');
        const testItems = document.querySelectorAll('.test-item'); // Элементы тестов
        const closeTestModalBtn = document.querySelector('.close-btn');
        const saveTestBtn = document.getElementById('save-test-btn');

        // Открытие модального окна для теста
        testItems.forEach((test) => {
            test.addEventListener('click', () => {
                testModal.style.display = 'flex';
            });
        });

        // Закрытие модального окна
        closeTestModalBtn.addEventListener('click', () => {
            testModal.style.display = 'none';
        });

        // Закрытие окна при клике вне его
        window.addEventListener('click', (event) => {
            if (event.target === testModal) {
                testModal.style.display = 'none';
            }
        });

        // Сохранение изменений
        saveTestBtn.addEventListener('click', () => {
            alert('Test saved!');
            testModal.style.display = 'none';
        });
    </script>
</body>
</html>
