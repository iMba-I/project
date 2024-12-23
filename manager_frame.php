<?php
session_start();
include "ConClass.php"; // Подключение базы данных

$email = $_SESSION['mail'] ?? null;
if (!$email) {
    die("User is not authenticated.");
}

try {
    $connection = Database::connection();

    // Получение office_id по email
    $stmt = $connection->prepare("SELECT office_id FROM users WHERE email = ?");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $connection->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($office_id);
    $stmt->fetch();
    $stmt->close();

    if (!$office_id) {
        die("Office ID not found.");
    }

    // Путь к директории
    $directory = __DIR__ . "/test_results/$office_id";
    if (!is_dir($directory)) {
        die("Directory does not exist.");
    }

    // Поиск последнего файла
    $files = glob("$directory/*");
    if (!$files) {
        die("No files found in the directory.");
    }

    $latestFile = array_reduce($files, function ($carry, $file) {
        return (filemtime($file) > filemtime($carry)) ? $file : $carry;
    }, reset($files));

    // Чтение данных из файла
    $data = array_map('str_getcsv', file($latestFile));
    $headers = array_shift($data); // Удаляем заголовки

    // Преобразуем строки в числовые значения и убираем пустые (null) значения
    foreach ($data as &$row) {
        foreach ($row as &$value) {
            $value = $value === null || $value === '' ? null : floatval($value);
        }
    }

    // Вычисление статистики
    $averages = [];
    $medians = [];
    $columnsCount = count($headers);

    for ($i = 0; $i < $columnsCount; $i++) {
        $columnValues = array_column($data, $i);

        // Фильтруем null значения
        $columnValues = array_filter($columnValues, function($value) {
            return !is_null($value);
        });

        // Среднее значение
        if (count($columnValues) > 0) {
            $averages[] = array_sum($columnValues) / count($columnValues);
        } else {
            $averages[] = null; // Если нет значений, ставим null
        }

        // Медианное значение
        sort($columnValues);
        if (count($columnValues) > 0) {
            $middle = floor(count($columnValues) / 2);
            $medians[] = (count($columnValues) % 2 === 0)
                ? ($columnValues[$middle - 1] + $columnValues[$middle]) / 2
                : $columnValues[$middle];
        } else {
            $medians[] = null; // Если нет значений, ставим null
        }
    }

    // Преобразование статистики в JSON
    $statistics = json_encode([
        'headers' => $headers,
        'averages' => $averages,
        'medians' => $medians
    ]);
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

if (key_exists('exit', $_POST)) {
    $_SESSION["mail"] = "";
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emply - Forward to Productivity</title>

    <link rel="stylesheet" href="test_style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .block {
            width: 100%;
            height: 100vh; /* Full viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
            color: white;
        }

        .block1 {
            background-color: #3498db;
        }

        .block2 {
            background-color: #e74c3c;
        }
    </style>
</head>

<body>
    <!-- Навигационная панель сверху -->
    <header>
        <div class="container2">
            <nav>
                <img src="img/icons/logo_black.png" alt="Emply Logo">
                <ul>
                    <li><a href="#">Интеграция</a></li>
                    <li><a href="#">Продукты</a></li>
                    <li><a href="#">Сообщество</a></li>
                    <li><a href="#">Контакты</a></li>
                </ul>
            </nav>

            <div class="buttons" id="log">
                <button class="btn2" id="exitButton">EXIT</button>
            </div>
        </div>
    </header>

    <!-- Главный контейнер -->
    <div class="main-wrapper">
        <!-- Контент страницы -->
        <div class="container">
            <!-- Боковое меню -->
            <aside class="sidebar">
                <div class="profile">
                    <img src="avatar.png" alt="Profile Picture" class="avatar">
                    <h2>Name Name</h2>
                    <p>example@gmail.com</p>
                </div>
            </aside>

            <!-- Основной контент -->
            <main class="main-content">
                <!-- Табы и графики -->
                <section class="content">
                    <div class="tabs">
                        <button>Статистика</button>
                        <button>Настройка тестов</button>
                        <button>Интеграция</button>
                        <button>Текст</button>
                        <button>Текст</button>
                    </div>
                    <!-- Графики -->
                    <div class="charts">
                        <div class="chart">
                            <p>Среднее значение</p>
                            <canvas id="chart1"></canvas>
                        </div>
                        <div class="chart">
                            <p>Медианное значение</p>
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
    <!-- Подвал -->
    <footer class="footer">
        <div class="footer-logo">
            <img src="img/icons/logo_black.png" alt="Logo">
            <p>forward to productivity</p>
        </div>
        <div class="footer-column">
            <h4>Use cases</h4>
            <a href="#">Diagramming</a>
            <a href="#">Brainstorming</a>
            <a href="#">Online whiteboard</a>
            <a href="#">Team collaboration</a>
        </div>
        <div class="footer-column">
            <h4>Explore</h4>
            <a href="#">Design</a>
            <a href="#">Prototyping</a>
            <a href="#">Development features</a>
            <a href="#">Design systems</a>
        </div>
        <div class="footer-column">
            <h4>Resources</h4>
            <a href="#">Blog</a>
            <a href="#">Best practices</a>
            <a href="#">Support</a>
            <a href="#">Developers</a>
            <a href="#">Resource library</a>
        </div>
    </footer>
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const exitButton = document.getElementById('exitButton');
    exitButton.addEventListener('click', () => {
        window.location.href = 'index.php'; // Перенаправление на файл в текущей директории
    });

    // Получение статистики из PHP
    const statistics = <?php echo $statistics; ?>;

    // Обработка null значений (например, заменяем на 0 или пропускаем)
    const averages = statistics.averages.map(value => value === null ? 0 : value);
    const medians = statistics.medians.map(value => value === null ? 0 : value);

    // Конфигурация для графика среднего
    const averageConfig = {
        type: 'bar',
        data: {
            labels: statistics.headers, // Используем реальные заголовки
            datasets: [{
                label: 'Средние значения',
                data: averages,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true }
    };

    // Конфигурация для графика медиан
    const medianConfig = {
        type: 'bar',
        data: {
            labels: statistics.headers,
            datasets: [{
                label: 'Медианные значения',
                data: medians,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true }
    };

    // Создание графиков
    new Chart(document.getElementById('chart1').getContext('2d'), averageConfig);
    new Chart(document.getElementById('chart2').getContext('2d'), medianConfig);
</script>

</html>
