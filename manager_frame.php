<?php
include "ConClass.php";
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
            background-color: #3498db; /* Blue */
        }
        .block2 {
            background-color: #e74c3c; /* Red */
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
            <div class="buttons">
                <button class="btn2">Sign in</button>
                <button class="btn2">Register</button>
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
                        <p>Статистика</p>
                        <canvas id="chart1"></canvas>
                    </div>
                    <div class="chart">
                        <p>Статистика</p>
                        <canvas id="chart2"></canvas>
                    </div>
                    <div class="chart">
                        <p>Статистика</p>
                        <canvas id="chart3"></canvas>
                    </div>
                    <div class="chart">
                        <p>Статистика</p>
                        <canvas id="chart4"></canvas>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
<?php
    // Define blocks with content
    $blocks = [
        ['class' => 'block1', 'content' => 'Block 1: Blue'],
        ['class' => 'block2', 'content' => 'Block 2: Red']
    ];

    // Generate blocks dynamically
    foreach ($blocks as $block) {
        echo "<div class='block {$block['class']}'>{$block['content']}</div>";
    }
    ?>
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
    // Конфигурация для графиков
    const chartConfig = (ctx) => ({
      type: 'line',
      data: {
        labels: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь'],
        datasets: [{
          label: 'Статистика',
          data: [20, 30, 40, 50, 70, 90],
          borderColor: 'blue',
          backgroundColor: 'rgba(0, 0, 255, 0.2)',
          borderWidth: 2,
          pointRadius: 5
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true, // Сохраняет соотношение сторон
        plugins: {
          legend: {
            display: true,
            position: 'top'
          }
        },
        scales: {
          x: {
            title: {
              display: true,
              text: 'Месяцы'
            }
          },
          y: {
            title: {
              display: true,
              text: 'Значения'
            },
            min: 0,
            max: 100
          }
        }
      }
    });

    // Создание графиков
    new Chart(document.getElementById('chart1').getContext('2d'), chartConfig());
    new Chart(document.getElementById('chart2').getContext('2d'), chartConfig());
    new Chart(document.getElementById('chart3').getContext('2d'), chartConfig());
    new Chart(document.getElementById('chart4').getContext('2d'), chartConfig());
  </script>



</html>
