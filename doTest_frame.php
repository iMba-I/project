<?php
include 'doTestLogic.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emply - Forward to Productivity</title>
    <link rel="stylesheet" href="main-style.css">
</head>
<body>
    <div class="xdd">
        <header>
            <div class="container">
                <nav>
                    <img src="img/icons/logo_black.png" alt="Empty Logo">
                    <ul>
                        <li><button>Интеграция</button></li>
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

        <section class="test" id="startTest_form">        
            <h1>Emply</h1>
            <div class="line1"></div>
            <button id="startTest_button">Начать тест</button>
        </section>
        <form id="testForm">
            <section class="voprosi hide" id="mainTest_form">
                <h1>Тестирование состояния</h1>
                <div class="line1"></div>
                <p>старайтесь обходить нейтральные ответы</p>
                <div class="qw_contaner">
                    <?php 
                        foreach ($questions as $index => $question) {
                            echo '<div class="qw"><br>';
                                echo '<p>Вопрос ' . htmlspecialchars($index + 1) . ': ' . htmlspecialchars($question['question']) . '</p>';
                                echo '<div class="options">';
                                echo '    <label><input type="radio" name="question' . $index . '" value="1" style="transform: scale(4);"></label>';
                                echo '    <label><input type="radio" name="question' . $index . '" value="2" style="transform: scale(3);"></label>';
                                echo '    <label><input type="radio" name="question' . $index . '" value="3" style="transform: scale(2);"></label>';
                                echo '    <label><input type="radio" name="question' . $index . '" value="4" style="transform: scale(1);"></label>';
                                echo '    <label><input type="radio" name="question' . $index . '" value="5" style="transform: scale(2);"></label>';
                                echo '    <label><input type="radio" name="question' . $index . '" value="6" style="transform: scale(3);"></label>';
                                echo '    <label><input type="radio" name="question' . $index . '" value="7" style="transform: scale(4);"></label>';
                                echo '</div>';
                            echo '</div>';
                        }
                    ?>
                    <button type="button" class="bb" id="endTest_button">Закончить тестирование</button>
                </div>
            </section>
        </form>


          <section class="end_test hide" id="endTest_form">        
            <h1>Emply</h1>
            <div class="line1"></div>
            <p>Тест пройден!<p>
            </section>

        </div>


        <footer>
            <div class="column">
             <img src="img/icons/logo_black.png" alt="Empty Logo">
             <p>forward to productivity</p>
         </div>   
         <div class="column">
            <h2>Use cases</h2>
            <ul>
                <li>Diagramming</li>
                <li>Brainstorming</li>
                <li>Online whiteboard</li>
                <li>Team collaboration</li>
            </ul>
        </div>
        <div class="column">
            <h2>Explore</h2>
            <ul>
                <li>Design</li>
                <li>Prototyping</li>
                <li>Development features</li>
                <li>Design systems</li>
            </ul>
        </div>
        <div class="column">
            <h2>Resources</h2>
            <ul>
                <li>Blog</li>
                <li>Best practices</li>
                <li>Support</li>
                <li>Developers</li>
                <li>Resource library</li>
            </ul>
        </div>
    </footer>

    <script>

    //const log = document.getElementById('login');
        const exitButton = document.getElementById('exitButton');
        const startTest_form = document.getElementById('startTest_form');
        startTest_form.classList.add('active');
        const startTest = document.getElementById('startTest_button');
        const mainTest_form = document.getElementById('mainTest_form');
        const endTest_button = document.getElementById('endTest_button');
        const endTest_form = document.getElementById('endTest_form');

        exitButton.addEventListener('click', () => {
            window.location.href = 'index.php'; // Перенаправление на файл в текущей директории
        });

        startTest.addEventListener('click', () => {
          startTest_form.classList.remove('active'); 
          mainTest_form.classList.remove('hide');
      });

        endTest_button.addEventListener('click', () => {

        const formData = new FormData(document.getElementById('testForm'));

        fetch('processTest.php', {
                method: 'POST',
                body: formData
            })
        .then(response => response.json())  // Ожидаем JSON ответ от сервера
        .then(data => {
            // Обрабатываем ответ сервера (например, выводим его на экран)
            alert('Тест отправлен! Результаты: ' + JSON.stringify(data));
        })
        .catch(error => {
            console.error('Ошибка:', error);
        });

        mainTest_form.classList.add('hide');
        endTest_form.classList.remove('hide');
      });

  </script>


</body>
</html>