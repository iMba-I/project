<?php

session_start();
require_once 'ConClass.php'; // подключаем класс Database

// Проверим, были ли отправлены данные
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем email из сессии
    $email = $_SESSION['mail'] ?? null; // если email не существует в сессии, вернем null

    if (!$email) {
        echo json_encode(['status' => 'error', 'message' => 'Ошибка: отсутствует email в сессии.']);
        exit;
    }

    // Получаем office_id из таблицы users по email
    $connection = Database::connection();
    $query = "SELECT office_id FROM users WHERE email = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Ошибка: не найден пользователь с таким email.']);
        exit;
    }

    $user = $result->fetch_assoc();
    $office_id = $user['office_id'];

    // Получаем текущую дату
    $current_date = date('Y-m-d'); // текущая дата в формате YYYY-MM-DD

    // Запрос для получения имени файла из таблицы test_results по office_id и test_date
    $query = "SELECT file_name FROM test_results WHERE office_id = ? AND test_date = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('is', $office_id, $current_date);
    $stmt->execute();
    $result = $stmt->get_result();

    // Если файл найден, берем его имя, иначе создаем новый
    if ($result->num_rows > 0) {
        // Файл существует, берем его имя
        $file_data = $result->fetch_assoc();
        $file_name = $file_data['file_name'];
    } else {
        // Файл не найден, создаем новый с текущей датой
        $file_name = 'test_results_' . $current_date . '.csv';
        
        // Вставляем новую запись в таблицу test_results с именем файла и текущей датой
        $query = "INSERT INTO test_results (office_id, test_date, file_name) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('iss', $office_id, $current_date, $file_name);
        $stmt->execute();
    }

    // Указываем путь для файла, добавляя office_id в путь
    $directory_path = $_SERVER['DOCUMENT_ROOT'] . '/project/test_results/' . $office_id . '/'; // Каталог с ID офиса
    if (!is_dir($directory_path)) {
        mkdir($directory_path, 0777, true); // Создаем каталог, если он не существует
    }

    // Полный путь к файлу
    $file_path = $directory_path . $file_name;

    // Открываем файл для записи (если он уже существует, то просто добавляем данные)
    $file = fopen($file_path, 'a'); // 'a' — append, добавляем в конец файла

    if ($file) {
        // Массив для хранения ответов
        $answers = [];

        // Перебираем все вопросы и сохраняем их ответы
        foreach ($_POST as $question => $answer) {
            $answers[$question] = htmlspecialchars($answer);
        }

        // Убедимся, что ответы содержат 20 элементов
        $expected_answers = array_fill(0, 20, 'NULL'); // создаем массив из 20 элементов, заполненный 'NULL'

        // Заполняем массив полученными ответами
        foreach ($answers as $key => $value) {
            // Если ключ соответствует ожидаемому (например, 'question1', 'question2', и т.д.)
            if (preg_match('/^question\d+$/', $key)) {
                // Находим индекс вопроса (например, question1 -> индекс 0, question2 -> индекс 1, ...)
                $index = (int)substr($key, 8) - 1; // берем цифру из названия вопроса и уменьшаем на 1, чтобы индексировать с 0
                // Сохраняем ответ в соответствующий индекс
                $expected_answers[$index] = $value;
            }
        }

        // Проверка, если файл пустой, записываем заголовки
        if (filesize($file_path) == 0) {
            // Если файл пустой, добавляем заголовки
            fputcsv($file, array_map(function($i) { return 'question' . ($i + 1); }, range(0, 19))); // Запишем заголовки
        }

        // Записываем данные в CSV файл
        fputcsv($file, $expected_answers);

        // Закрываем файл
        fclose($file);

        // Отправляем ответ в формате JSON
        echo json_encode(['status' => 'success', 'message' => 'Результаты сохранены в файл: ' . $file_path]);
    } else {
        // Если не удалось открыть файл
        echo json_encode(['status' => 'error', 'message' => 'Ошибка при открытии файла']);
    }
}
?>
