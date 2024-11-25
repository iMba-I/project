<?php
session_start();
require_once 'ConClass.php'; // Подключаем класс Database

// Проверяем, есть ли email в сессии
if (!isset($_SESSION['mail'])) {
    die("Пользователь не авторизован.");
}

$mail = $_SESSION['mail'];

// Подключение к базе данных
$db = Database::connection();

// Шаг 1: Получение office_id и tests_filename
$query = $db->prepare("
    SELECT offices.tests_filename 
    FROM users 
    INNER JOIN offices ON users.office_id = offices.id 
    WHERE users.email = ?
");
$query->bind_param('s', $mail);
$query->execute();
$result = $query->get_result();
if ($result->num_rows === 0) {
    die("Файл с вопросами не найден.");
}
$row = $result->fetch_assoc();
$tests_filename = $row['tests_filename'];

// Формируем полный путь к файлу
$tests_path = __DIR__ . '/tests/' . $tests_filename;

// Шаг 2: Чтение файла с ID вопросов
$question_ids = [];
$today = date('Y-m-d'); // Получаем текущую дату

if (file_exists($tests_path)) {
    $csvData = array_map('str_getcsv', file($tests_path));
    
    foreach ($csvData as $line) {
        // Дата в последнем столбце
        $date = isset($line[20]) ? trim($line[20]) : '';

        // Проверяем, если дата совпадает с сегодняшней
        if ($date === $today) {
            // Идем по всем столбцам ID (с 0 по 19) и добавляем валидные ID
            for ($i = 0; $i < 20; $i++) {
                if (!empty($line[$i]) && $line[$i] !== 'NULL') {
                    $question_ids[] = (int)$line[$i]; // Добавляем ID вопроса, если оно не пустое и не NULL
                }
            }
        }
    }
} else {
    die("Файл с ID вопросов не найден в директории tests.");
}

// Проверяем, есть ли вопросы для сегодняшней даты
if (empty($question_ids)) {
    die("Вопросы для сегодняшней даты не найдены.");
}

// Шаг 3: Получение вопросов из таблицы questions
$placeholders = implode(',', array_fill(0, count($question_ids), '?'));
$query = $db->prepare("
    SELECT id, question 
    FROM questions 
    WHERE id IN ($placeholders)
");
$query->bind_param(str_repeat('i', count($question_ids)), ...$question_ids);
$query->execute();
$result = $query->get_result();

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}
?>
